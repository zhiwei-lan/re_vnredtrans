<?php

namespace App\Services\Frontend;

use App\Models\FormModel;
use App\Models\FormFieldsModel;
use App\Models\FormSubmitModel;
use App\Models\MediaModel;
use App\Models\MediaRelationsModel;
use App\Models\MediaDownloadTokenModel;
use App\Services\Backend\MediaService;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FormService
{
    protected FormModel $FormModel;
    protected FormFieldsModel $FormFieldsModel;
    protected FormSubmitModel $FormSubmitModel;
    protected MediaModel $MediaModel;
    protected MediaRelationsModel $MediaRelationsModel;
    protected MediaDownloadTokenModel $MediaDownloadTokenModel;
    protected MediaService $MediaService;

    public function __construct()
    {
        $this->FormModel        = new FormModel();
        $this->FormFieldsModel  = new FormFieldsModel();
        $this->FormSubmitModel  = new FormSubmitModel();
        $this->MediaModel       = new MediaModel();
        $this->MediaRelationsModel = new MediaRelationsModel();
        $this->MediaDownloadTokenModel = new MediaDownloadTokenModel();
        $this->MediaService     = new MediaService();
    }
    public function getFormWithCode(string $formCode)
    {
        $locale = service('lang')->getLocale();
        $data = $this->FormModel->where('code',$formCode)->where('lang',$locale)->orderBy('version', 'DESC')->first();
        //无对应语言版本则使用默认语言
        if (! $data) {
            $data = $this->FormModel->where('code',$formCode)->where('lang',config('App')->defaultLocale)->orderBy('version', 'DESC')->first();
        }
        return $data;
    }
    /**
     * 提交表单
     */
    public function submit(
        string $formCode,
        array $params,
        array $files,
        array $meta
    )
    {
        if ($params['checkme']) { 
             // 隐藏字段checkme被填写  直接判定为机器人
            return [
                'code'    => 200,
                'message' => lang('Form.submit.success')
            ];
        }
        // 页面载入到提交 时间少于3秒 直接判定为机器人
        $ts = (int) $params['quicktime'];
        $cost = time() - $ts;
        if ($cost < 3) {
           return [
                'code'    => 200,
                'message' => lang('Haoadmin.form.msg.success')
           ];
        }
        //大于60分钟 提示刷新页面
        if ($cost > 3600) {
            return [
                'code' => 422,
                'message' => lang('Haoadmin.form.msg.timeout')
            ];
        }

        // 同 IP 1 分钟内只允许 提交1 次
        $ip = $meta['ip'] ?? null;

        $count = $this->FormSubmitModel
            ->where('ip', $ip)
            ->where(
                'created_at >=',
                date('Y-m-d H:i:s', strtotime('-1 minute'))
            )
            ->countAllResults();

        if ($count > 0) {
            return [
                'code' => 422,
                'message' => lang('Haoadmin.form.msg.err_too_fast', [1]),
            ];
        }

        // 读取表单 & 字段定义
        $form = $this->FormModel
            ->where('code', $formCode)
            ->orderBy('version', 'DESC')
            ->first();

        if (! $form) {
            return [
                'code' => 422,
                'message' => 'Form not found'
            ];
        }
        //读取字段规则
        $formFields = $this->FormFieldsModel
            ->where('form_code', $formCode)
            ->where('lang', $meta['lang'] ?? config('App')->defaultLocale)
            ->where('version', $form['version'])
            ->find();

        // 构建验证规则
        $rules    = [];
        $messages = [];

        foreach ($formFields as $field) {

            if (in_array($field['type'], ['submit', 'button'])) continue;

            $name  = $field['name'];
            $label = $field['label'];

            $ruleStack = [];

            // ---------- 基础 required ----------
            if ((int)$field['required'] === 1) {
                $ruleStack[] = 'required';
                $messages[$name]['required'] = lang('Haoadmin.form.msg.err_required', [$label]);
            }

            // ---------- 获取提交值 ----------
            $value = $params[$name] ?? null;

            // checkbox / multi-select 会是数组
            if (in_array($field['type'], ['checkbox-group', 'radio-group'])) {
                $value = $value ?? [];
            }

            $isEmpty = ($value === null || $value === '' || (is_array($value) && empty($value)));

            // ---------- 自定义 validation ----------
            if (!empty($field['validation']) && (!$isEmpty || (int)$field['required'] === 1)) {
                $ruleStack[] = $field['validation'];
            }

            // ---------- 类型级规则，只在有值或必填时 ----------
            if (!$isEmpty || (int)$field['required'] === 1) {
                switch ($field['type']) {
                    case 'email':
                        $ruleStack[] = 'valid_email';
                        $messages[$name]['valid_email'] = lang('Haoadmin.form.msg.err_valid_email', [$label]);
                        break;

                    case 'tel':
                        $ruleStack[] = 'regex_match[/^[0-9+\-\s]+$/]';
                        break;
                    case 'radio-group':
                        $rules[$name] = implode('|', array_filter($ruleStack));
                        continue 2;
                    case 'checkbox-group':
                        $rules[$name.'.*'] = implode('|', array_filter($ruleStack));
                        continue 2;

                    case 'file':
                        $maxSize = ((int)config('Site')->file_max_size ?? 3) * 1024; // KB
                        $uploadedFiles = $files[$name] ?? null;

                        if ($uploadedFiles instanceof \CodeIgniter\HTTP\Files\UploadedFile) {
                            $uploadedFiles = [$uploadedFiles];
                        }

                        $uploadedFiles = is_array($uploadedFiles) ? $uploadedFiles : [];
                        $hasFile = false;
                        if (!empty($uploadedFiles)) {
                            foreach ($uploadedFiles as $file) {
                                if ($file->isValid() && !$file->hasMoved()) {
                                    $hasFile = true;
                                    break;
                                }
                            }
                        }

                        $fileRules = [];
                        if ((int)$field['required'] === 1) {
                            $fileRules[] = 'uploaded['.$name.']';
                        }
                        if ($hasFile) {
                            $fileRules[] = 'max_size['.$name.','.$maxSize.']';
                            $fileRules[] = 'ext_in['.$name.',jpg,jpeg,png,pdf]';
                        }

                        if (!empty($fileRules)) {
                            $rules[$name.'[]'] = implode('|', $fileRules);
                            $messages[$name.'[]'] = [
                                'uploaded' => lang('Haoadmin.form.msg.err_uploaded'),
                                'max_size' => lang('Haoadmin.form.msg.err_max_size'),
                                'ext_in'   => lang('Haoadmin.form.msg.err_ext_in')
                            ];
                        }
                        continue 2;
                }
            }

            // 普通字段
            if (!empty($ruleStack)) {
                $rules[$name] = implode('|', $ruleStack);
            }
        }
        
        //执行验证
        if (! $this->validateData($params, $rules, $messages)) {
            return [
                'code'   => 422,
                'message'=> 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];
        }

        // 处理文件和普通字段
        $payload = [];
        $files = $files;
        
        foreach($formFields as $field){
            if(in_array($field['type'], ['submit','button'])) continue;
            $name = $field['name'];

            // 文件字段
            if($field['type']==='file'){
                $payload[$name] = [];
                $fileItems = $files[$name] ?? null;
                if ($fileItems instanceof \CodeIgniter\HTTP\Files\UploadedFile) {
                    $fileItems = [$fileItems];
                }

                $fileItems = is_array($fileItems) ? $fileItems : [];

                

                foreach($fileItems as $file){
                    if(!$file->isValid() || $file->hasMoved()) continue;
                    // 使用 writable/uploads 目录，确保上传文件不暴露在公网
                    $uploadDir = WRITEPATH . 'uploads/forms/' . date('Y/m');
                    
                    // 确保目录存在
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0750, true);
                    }
                    
                    $newName = $file->getRandomName();
                    $file->move($uploadDir, $newName);
                    
                    $relativePath = 'forms/' . date('Y/m') . '/' . $newName;
                    // 生成 upload token
                    $uploadToken ??= bin2hex(random_bytes(16));
                    // 同步到媒体表 - 记录文件信息以便统一管理
                    $mediaData = [
                        'path'          => $relativePath,
                        'original_name' => $file->getClientName(),
                        'extension'     => $file->getExtension(),
                        'mime'          => $file->getMimeType(),
                        'size'          => $file->getSize(),
                        'type_group'    => 'file', // 表单上传文件类型
                        'is_used'       => 1, // 标记为已使用
                        'created_by'    => $meta['user_id'] ?? null,
                        'public'   => 0, // 表单上传文件默认不公开
                        'upload_token' => $uploadToken,
                    ];
                    
                    $mediaId = $this->MediaModel->insert($mediaData);
                    // 注：submitId 此时还未生成，将在后面的关联步骤中处理
                    //同步到媒体外部下载表
                    $this->MediaDownloadTokenModel->insert([
                        'media_id'    => $mediaId,
                        'token'       => $uploadToken,
                        'expires_at'  => date('Y-m-d H:i:s', strtotime('+7 days')), // 7天过期
                        'max_uses'    => 5,// 最多允许下载5次
                        'used_times'  => 0
                    ]);

                    $payload[$name][] = [
                        'origin'   => $file->getClientName(),
                        'path'     => $relativePath,
                        'size'     => $file->getSize(),
                        'type'     => $file->getClientMimeType(),
                        'media_id' => $mediaId, // 记录媒体ID用于后续关联
                        'token'       => $uploadToken,
                    ];

                }
                
                continue;
            }

            // 普通字段
            $value = $params[$name] ?? null;
            $payload[$name] = $value;
        }

        // 入库
        if (! $this->FormSubmitModel->insert([
            'form_code' => $formCode,
            'lang'      => $meta['lang'] ?? config('App')->defaultLocale,
            'version'   => $form['version'],
            'data'      => json_encode($payload, JSON_UNESCAPED_UNICODE),
            'user_agent'=> $meta['userAgent'],
            'ip'        => $meta['ip'],
            'created_by'   => $meta['user_id'] ?? null,
        ])) {
            return [
                'code' => 422,
                'message' => 'Failed to save submission'
            ];
        }
        $submitId = $this->FormSubmitModel->getInsertID();
        // 建立媒体关联 - 将上传的文件与表单提交关联起来
        $this->syncFormMediaRelations($submitId, $formCode, $payload);
        
        // 返回成功
        return [
            'code'    => 200,
            'message' => lang('Haoadmin.form.msg.success'),
            'submit_id' => $submitId
        ];

    }

    //调用验证器
    protected function validateData(array $data, array $rules, array $messages = []): bool
    {
        $validation = \Config\Services::validation();
        $validation->setRules($rules, $messages);
        $this->validator = $validation;
        return $validation->run($data);
    }

    /**
     * 同步表单提交的媒体关联
     * 将上传的文件与表单提交记录进行关联
     */
    protected function syncFormMediaRelations(int $submitId, string $formCode, array $payload): void
    {
        $relations = [];
        $sort = 0;

        foreach ($payload as $fieldName => $fieldValue) {
            // 只处理文件字段
            if (!is_array($fieldValue) || empty($fieldValue)) {
                continue;
            }

            // 检查是否是文件字段（包含 media_id）
            if (isset($fieldValue[0]['media_id'])) {
                foreach ($fieldValue as $file) {
                    $relations[] = [
                        'media_id'   => $file['media_id'],
                        'owner_type' => 'form_submit',
                        'owner_id'   => $submitId,
                        'usage_type' => 'attachment',
                        'sort'       => $sort++,
                    ];
                }
            }
        }

        // 批量插入媒体关联
        if (!empty($relations)) {
            $this->MediaRelationsModel->insertBatch($relations);
        }
    }

    


}
