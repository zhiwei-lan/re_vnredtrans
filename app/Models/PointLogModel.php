<?php

namespace App\Models;

use CodeIgniter\Model;

class PointLogModel extends Model
{
    protected $table          = 'members_points_log';
    protected $primaryKey     = 'id';
     protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields  = [
        'user_id',
        'change_points',
        'before_points',
        'after_points',
        'type',
        'description',
        'related_id',
    ];


    public function getHistroy($user_id,$limit = 10 ,$offset = 0)
    {
        return $this->where(['user_id' => $user_id])->findAll($limit, $offset);
    }
}