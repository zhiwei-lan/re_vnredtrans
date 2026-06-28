<?php

namespace App\Models;
use CodeIgniter\Model;


class UsersJoinModel extends Model
{
     protected $table = 'auth_identities';
     protected $primaryKey = 'id';
     protected $allowedFields = ['secret','secret2','user_id','type','created_at'];
    
}
