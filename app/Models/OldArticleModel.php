<?php
namespace App\Models;

use CodeIgniter\Model;

class OldArticleModel extends Model
{
    protected $table = 'taxonomy_article';
    protected $primaryKey = 'article_index';
    protected $allowedFields = [
        'article_index', 'article_title', 'category_index', 'article_image', 'article_big_image', 'article_content', 'article_created_time'
    ];

}
