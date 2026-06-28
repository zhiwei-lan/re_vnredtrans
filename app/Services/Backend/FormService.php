<?php

namespace App\Services\Backend;

use App\Models\FormModel;
use App\Models\FormFieldsModel;
use App\Models\FormSubmitModel;
use App\Models\EmailQueueModel;
use App\Libraries\UserAgentDisplay;

use Config\Database;

class FormService
{
    protected FormModel $FormModel;
    protected FormFieldsModel $FormFieldsModel;
    protected FormSubmitModel $FormSubmitModel;
    protected EmailQueueModel $EmailQueueModel;

    public function __construct()
    {
        $this->FormModel  = new FormModel();
        $this->FormFieldsModel     = new FormFieldsModel();
        $this->FormSubmitModel     = new FormSubmitModel();
        $this->EmailQueueModel     = new EmailQueueModel();
    }

    //查看表单信息
    public function readSubmit(int $formSubmitId, string $formCode):array
    {
        $submit = $this->FormSubmitModel->find($formSubmitId);
        if (!$submit) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('not found form submit record');
        }
        

        // 字段定义（必须按 version）
        $fields = $this->FormFieldsModel
            ->where('form_code', $formCode)
            ->where('lang', $submit['lang'])
            ->where('version', $submit['version'])
            ->findAll();

        //  解析 JSON
        $submitData = json_decode($submit['data'], true) ?? [];

        // 重建可读数据
        $data = [];

        foreach ($fields as $field) {
            $name  = $field['name'];
            $type  = $field['type'];
            $value = $submitData[$name] ?? null;

            // 类型处理 
            switch ($type) {

                case 'file':
                    // 多文件
                    $value = is_array($value) ? $value : [];
                    break;

                case 'checkbox-group':
                    $value = is_array($value)
                        ? implode(', ', $value)
                        : null;
                    break;

                case 'radio-group':
                case 'select':
                    // 直接是字符串
                    break;

                default:
                    // text / textarea / email
                    $value = is_string($value) ? $value : null;
            }

            $data[] = [
                'label' => $field['label'],
                'name'  => $name,
                'type'  => $type,
                'value' => $value,
            ];
        }

        return [
            'data'      => $data,
            'submit'    => $submit
        ];
    }
    //datatable形式 提交的表单列表
    public function getSubmitDataTable(array $params, string $formCode): array
    {
        $start  = (int) ($params['start'] ?? 0);
        $length = (int) ($params['length'] ?? 10);
        $search = $params['search']['value'] ?? null;
        $order  = $params['order'] ?? 'id';
        $dir    = $params['dir'] ?? 'desc';

        $orderableFields = ['id', 'title', 'created_at'];

        if (! in_array($order, $orderableFields, true)) {
            $order = 'id';
        }

        if (! in_array($dir, ['asc', 'desc'], true)) {
            $dir = 'desc';
        }
        $rows = $this->FormSubmitModel->getDataTableData(
                $start,
                $length,
                $order,
                $dir,
                $search
        );
        /* ---------- 格式化输出 ---------- */

        foreach ($rows as &$row) {
            if (!empty($row['user_agent'])) {
                $row['user_agent'] = UserAgentDisplay::format($row['user_agent']);
            }

            $row['ip_address'] = $row['ip_address'] ?? '-';
        }
        unset($row);

        return [
            'data'            => $rows,
            'recordsTotal'    => $this->FormSubmitModel->countAllData(),
            'recordsFiltered' => $this->FormSubmitModel->countFilteredData($search),
        ];
    }



    //查询form模板信息 （含版本列表）
    public function show(int $formId = null): array
    {
        $data = $this->FormModel->find($formId);

        if (!$data) {
            return [];
        }

        $data['version_list'] = $this->FormModel
        ->where('code', $data['code'])
        ->where('lang', $data['lang'])
        ->orderBy('version', 'desc')
        ->limit(10)
        ->findAll();

        return $data;
    }
            

    /**
     * 创建 / 更新（统一入口）
     */
    public function save(array $data, ?int $id = null): int
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            if ($id === null) {
                $data['version'] = 0;
                if(!$this->FormModel->insert($data)){
                     throw new \RuntimeException(json_encode($this->FormModel->errors()));
                }
                $formId = $this->FormModel->getInsertID();
            } else {
                $form = $this->FormModel
                    ->where('id', $id)
                    ->orderBy('version', 'desc')
                    ->first();

                $data['version'] = (int)$form['version'] + 1;
                $data['code']    = $form['code'];

                $this->FormModel->insert($data);
                $formId = $this->FormModel->getInsertID(); 
            }

            $this->syncFields($data, json_decode($data['fields'], false));

            $db->transCommit();
            return $formId;

        } catch (\Throwable $e) {
            $db->transRollback();
            dd($e);
            throw $e;
        }
    }
    
    /**
     * 同步fields验证规则
     */
    protected function syncFields(array $data, array $fields): void
    {
        //写入新规则
        foreach ($fields as $field) {
            if(empty($field->name)){
                continue;
            }
            $fieldArray = [
                'form_code' => $data['code'],
                'lang' => $data['lang'],
                'name' => $field->name,
                'label' => $field->label??'',
                'type' => $field->subtype??$field->type,
                'required' => !empty($field->required) ? 1 : 0,
                'version' =>$data['version']
            ];
            if(!$this->FormFieldsModel->insert($fieldArray)){
                throw new \RuntimeException(json_encode($this->FormFieldsModel->errors()));
            }
        }
    }

    //添加到队列
    public function pushToQueue(int $formSubmitId ,string $formCode){

        $formData = $this->readSubmit($formSubmitId, $formCode);
        $form = $this->FormModel
            ->where('code', $formData['submit']['form_code'])
            ->where('lang', $formData['submit']['lang'] ?? config('App')->defaultLocale)
            ->orderBy('version', 'DESC')
            ->first();

        if(empty($form['submit_email'])) {
            return;
        }
        $site = service('site')->getSiteInfo();
        //加入邮件队列
        $to = $form['submit_email'];
        $subject = $site->site_name . ': ' . $form['success_message'];
        $message = view('Backend/Mail/form_submit', [
            'data' => $formData['data'],
            'submit' => $formData['submit'],
            'success_message' => $form['success_message']??'',
            'site_name' => $site->site_name
        ],
        ['debug' => false]
        );
        $this->EmailQueueModel->push($form['submit_email'], $subject, $message);

    }
}
