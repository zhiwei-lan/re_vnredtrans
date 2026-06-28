<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FormModel; 
use App\Services\Frontend\FormService;

/**
 * Class FormController.
 */
class FormController extends BaseController
{
    use ResponseTrait;

    protected FormModel $FormModel;
    protected FormService $FormService;

    public function __construct()
    {
        $this->FormModel = new FormModel();
        $this->FormService = new FormService();
    }

    //显示表单
    public function show(string $formCode)
    {
        $data = $this->FormService->getFormWithCode($formCode);
        return $this->renderView('form/'.$formCode, [
            'form' => $data,
            'form_code' => $formCode
        ]);
    }
    //表单提交
    public function submit(string $formCode)
    {   
        $meta = [
            'ip'        => $this->request->getIPAddress(),
            'userAgent' => $this->request->getUserAgent()->getAgentString(),
            'user_id'   => auth()->id()??null,
            'lang'      => service('lang')->getLocale(),
        ];
        $params = $this->request->getPost();
        $files = $this->request->getFiles();
        // 提交表单
        $result = $this->FormService->submit(
            $formCode,
            $params,
            $files,
            $meta
        );
        // 提交成功后，推送邮件到队列
        if ($result['code'] === 200) {
            (new \App\Services\Backend\FormService())->pushToQueue($result['submit_id'], $formCode);
        }
        return $this->response->setJSON($result)->setHeader('X-CSRF-TOKEN', csrf_hash());
    }


}
