<?php
namespace App\Models;

use CodeIgniter\Model;

class OldCategoryModel extends Model
{
    protected $table = 'taxonomy';
    protected $primaryKey = 'taxonomy_index';
    protected $allowedFields = [
        'taxonomy_index', 'parent_index', 'taxonomy_name'
    ];

}
