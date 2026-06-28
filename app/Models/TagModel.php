<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tags';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';

    protected $allowedFields = [
        'name',
        'slug',
        'description',
        'is_indexable',
        'article_count',
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
        'slug' => 'required|alpha_dash|min_length[2]|max_length[100]',
    ];

    /**
     * 根据 slug + site 获取 tag
     */
    public function findBySlug(string $slug, int $siteId)
    {
        return $this->where('slug', $slug)
                    ->where('site_id', $siteId)
                    ->first();
    }

    /**
     * 更新文章数量缓存
     */
    public function refreshArticleCount(int $tagId): void
    {
        $count = db_connect()
            ->table('article_tags')
            ->where('tag_id', $tagId)
            ->countAllResults();

        $this->update($tagId, ['article_count' => $count]);
    }
}
