<?php
namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
    protected $table = 'sites';
    protected $allowedFields = [
        'name','theme','active','description'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
