<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\MediaModel;
use CodeIgniter\API\ResponseTrait;
use App\Services\Backend\MediaService;

class MediaController extends AdminBaseController
{
    use ResponseTrait;
    protected MediaService $MediaService;
    
    public function __construct()
    {
        $this->MediaService = new MediaService();
    }
    /**
     * 通用文件上传
     */
    public function create()
    {
        $file = $this->request->getFile('file')
            ?? $this->request->getFile('image')
            ?? $this->request->getFile('video');
        
        if (! $file) {
            return $this->fail('No file uploaded');
        }

        try {
            //调用文件服务
            $result = $this->MediaService->upload(
                $file,
                auth()->user()->id,
                $this->request->getPost('upload_token')
            );

            return $this->respond([
                'status' => 'success',
                ...$result
            ]);
        } catch (\Throwable $e) {
            return $this->fail($e->getMessage());
        }
    }

}