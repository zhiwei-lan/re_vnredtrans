<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleTagModel extends Model
{
    protected $table            = 'article_tags';
    protected $primaryKey       = null;
    protected $returnType       = 'array';
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'article_id',
        'tag_id',
    ];
}