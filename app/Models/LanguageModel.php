<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table      = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['trans_id','trans_type','lang','content','title','subject','description'];


}