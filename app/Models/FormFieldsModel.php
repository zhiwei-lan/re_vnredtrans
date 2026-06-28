<?php
namespace App\Models;

use CodeIgniter\Model;

class FormFieldsModel extends Model
{
    protected $table = 'form_fields';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'form_code','name','label','type','options',
        'validation','required','sequence','active','version','lang'
    ];
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

   
}


