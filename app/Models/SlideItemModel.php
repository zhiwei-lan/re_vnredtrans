<?php

namespace App\Models;

use CodeIgniter\Model;

class SlideItemModel extends Model
{
    protected $table      = 'slide_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['image','title','subject', 'description','content','video','url','open_new','slide_id','lang'];

    public function deleteBySlideId(int $slideId): bool
    {
        return $this->where('slide_id', $slideId)->delete();
    }
}