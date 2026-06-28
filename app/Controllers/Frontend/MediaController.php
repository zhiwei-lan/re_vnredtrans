<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Services\FileService;

/**
 * Class MediaController.
 */
class MediaController extends BaseController
{

    protected FileService $FileService;

    public function __construct()
    {
        $this->FileService = new FileService();
    }

    //download File
    public function download(int $mediaId)
    {
        $token = $this->request->getGet('token');
        $file =  $this->FileService->download($mediaId,$token);
        
        if (! $file) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', $file['mime'])
            ->download($file['path'], null)
            ->setFileName($file['name']);
    }
}
