<?php

namespace App\Services;
use App\Models\MediaModel;
use App\Models\MediaDownloadTokenModel;
class FileService
{
    protected MediaModel $mediaModel;
    protected MediaDownloadTokenModel $MediaDownloadTokenModel;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
        $this->MediaDownloadTokenModel = new MediaDownloadTokenModel();
    }

    public function download(int $fileId, ?string $token = null)
    {
        $file = $this->mediaModel->find($fileId);
        if (! $file) {
            return null;
        }
        // 公开文件
        if ($file['public'] == 1) {
            return $this->buildResponse($file);
        }

        // 私有文件
        if ($token) {
            if (! $this->validateToken($fileId, $token)) {
                return null;
            }
            return $this->buildResponse($file);
        }

        // 没 token → 走登录权限
        if (auth()->loggedIn() && auth()->user()->inGroup('admin','superadmin')) {
            return $this->buildResponse($file);
        }

        return null;
    }

    protected function buildResponse(array $file): ?array
    {
        $path = $this->resolvePath($file);

        if (! is_file($path)) {
            return null;
        }

        return [
            'path' => $path,
            'name' => $file['original_name'] ?? basename($path),
            'mime' => $file['mime'] ?? mime_content_type($path),
        ];
    }

    protected function validateToken(int $fileId, string $token): bool
    {
        $row = $this->MediaDownloadTokenModel
            ->where('media_id', $fileId)
            ->where('token', $token)
            ->first();

        if (! $row) return false;

        if ($row['expires_at'] && strtotime($row['expires_at']) < time()) {
            return false;
        }

        if ($row['max_uses'] && $row['used_times'] >= $row['max_uses']) {
            return false;
        }

        // 原子递增
        $this->MediaDownloadTokenModel
            ->where('id', $row['id'])
            ->set('used_times', 'used_times + 1', false)
            ->update();

        return true;
    }

    protected function resolvePath(array $file): string
    {
        return match ($file['public']) {
            '1'  => ROOTPATH . 'public/' . $file['path'],
            '0' => WRITEPATH . 'uploads/' . $file['path'],
        };
    }
}
