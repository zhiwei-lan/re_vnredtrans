<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaRelationsModel extends Model
{
    protected $table = 'media_relations';
    protected $allowedFields = ['media_id', 'owner_type', 'owner_id', 'usage_type', 'sort'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * 获取文章图片关系
     */
    public function findArticleImageRelations(int $id)
    {
        $relations = $this->where('owner_type', 'article')
            ->where('owner_id', $id)
            ->orderBy('sort', 'asc')
            ->findAll();

        // 3️⃣ 按 usage_type 分类
        $thumbnail_image_ids = [];
        $gallery_image_ids  = [];

        foreach ($relations as $rel) {
            switch ($rel['usage_type']) {
                case 'thumbnail':
                    $thumbnail_image_ids[] = $rel['media_id'];
                    break;

                case 'gallery':
                    $gallery_image_ids[] = $rel['media_id'];
                    break;
            }
        }
        
        return  [
            'thumbnail_image_ids' => $thumbnail_image_ids,
            'gallery_image_ids' => $gallery_image_ids
        ];
    }
}