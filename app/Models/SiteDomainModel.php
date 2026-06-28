<?php
namespace App\Models;

use CodeIgniter\Model;

class SiteDomainModel extends Model
{
    protected $table = 'site_domains';
    protected $allowedFields = [
        'site_id','domain','is_primary','active'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
