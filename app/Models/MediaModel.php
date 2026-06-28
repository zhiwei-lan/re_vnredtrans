<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $allowedFields = [
        'path',
        'original_name',
        'extension', 
        'mime', 
        'size', 
        'width', 
        'height',
        'type_group',
        'is_used',
        'upload_token',
        'created_by',
        'public',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    /**
     * 根据指定 ID 数组获取图片，并保持顺序
     */
    public function findByIdsInOrder(array $ids = [])
    {
        if (empty($ids)) {
            return [];
        }
        return $this->whereIn('id', $ids)
                    ->orderBy('FIELD(id,' . implode(',', $ids) . ')')
                    ->findAll();
    }
}