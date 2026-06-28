<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Services\Backend\FormService;
use App\Models\FormSubmitModel;
use App\Models\FormFieldsModel;
use App\Models\FormModel;
use App\Services\Backend\MediaService;



class FormController extends AdminBaseController
{
    use ResponseTrait;
    protected FormService $FormService;
    protected FormModel $FormModel;
    protected FormSubmitModel $FormSubmitModel;
    protected FormFieldsModel $FormFieldsModel;
    protected MediaService $MediaService;

    public function __construct()
    {
        $this->FormService = new FormService();
        $this->FormModel = new FormModel();
        $this->FormSubmitModel = new FormSubmitModel();
        $this->FormFieldsModel = new FormFieldsModel();
        $this->MediaService = new MediaService();
    }
    //表单提交详情
    public function read(string $formCode)
    {
        $submitId = (int) $this->request->getGet('id');
        $data = $this->FormService->readSubmit($submitId, $formCode);

        //更新已读状态
        $this->FormSubmitModel->update($submitId, ['view_count'=>1]);

        return view('Backend/Form/read', [
            'title'    => lang('Haoadmin.contact.title'),
            'subtitle' => lang('Haoadmin.contact.subtitle'),
            'form_code' => $formCode,
            'data'      => $data['data'],
            'submit'      => $data['submit']
        ]);
    }

    //表单提交列表
    public function list($formCode)
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(
                $this->FormService->getSubmitDataTable($this->request->getGet(),$formCode)
            );
        }
         return view('Backend/Form/list', [
            'title'    => lang('Haoadmin.contact.title'),
            'subtitle' => lang('Haoadmin.contact.subtitle'),
            'form_code' => $formCode
        ]);
    }
    //删除表单提交信息
    public function delete(int $id)
    {
        try {
            //删除表单提交信息
            $this->FormSubmitModel->delete($id);
            //删除关联媒体及中间表
            $this->MediaService->deleteByOwner($id);

            return redirect()->back()->with('sweet-success', lang('Haoadmin.form.msg.msg_delete'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with(
                'error',
                json_decode($e->getMessage(), true) ?? ['general' => $e->getMessage()]
            );
        }
    }
    
    //表单设置列表
    public function index()
    {
        if ($this->request->isAJAX()) {
            $params = $this->request->getGet();
            $result = $this->FormModel->getDataTable($params);
            return $this->respond($result);
        }
         return view('Backend/Form/index', [
            'title'    => lang('Haoadmin.form.title'),
            'subtitle' => lang('Haoadmin.form.subtitle'),
        ]);
    }
    //添加或查看
    public function show(int $id = null)
    {   
        if(empty($id)){
            return view('Backend/Form/write', [
                'title'    => lang('Haoadmin.form.title'),
                'subtitle' => lang('Haoadmin.form.add')
            ]);
        }
        
        $form = $this->FormService->show($id);
        return view('Backend/Form/write', [
            'title'    => lang('Haoadmin.form.title'),
            'subtitle' => $form['code'],
            'form'  => $form
        ]);

        
    }

    // 新增或修改
    public function write(int $id = null)
    {   
        $params = $this->request->getPost();
        try {
            if ($id == null) {
                //新增
                $this->FormService->save($params);
                return redirect()->back()->with('sweet-success', lang('Haoadmin.form.msg.msg_insert'));
            }else{
                //修改（为保障版本回退以及历史表单重构 此处为假更新 实际为新增 通过version判断版本 重建历史表单数据）
                $this->FormService->save($params,$id);
                return redirect()->back()->with('sweet-success', lang('Haoadmin.form.msg.msg_insert'));
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with(
                'error',
                json_decode($e->getMessage(), true) ?? ['general' => $e->getMessage()]
            );
        }
    }

}