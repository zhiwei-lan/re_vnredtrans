<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaDownloadTokenModel extends Model
{
    protected $table = 'media_download_tokens';
    protected $allowedFields = [
        'media_id',
        'token',
        'expires_at', 
        'max_uses', 
        'used_times'
    ];

}