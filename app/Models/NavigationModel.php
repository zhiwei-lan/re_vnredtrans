<?php

namespace App\Models;
use CodeIgniter\Model;

class NavigationModel extends Model
{
    protected $table = 'navigation';
    protected $primaryKey = 'id';

    protected $returnType = 'array'; 

    protected $allowedFields = [
        'parent_id', 'active', 'title', 'url', 'sequence','subject','description','open_new'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Trigger
    protected $afterInsert = ['deleteCacheMenu'];
    protected $afterUpdate = ['deleteCacheMenu'];
    protected $afterDelete = ['deleteCacheMenu'];

    // Validation
    protected $validationRules = [
        'parent_id' => 'required|numeric',
        'active'    => 'required|numeric',
        'title'     => 'required|min_length[2]|max_length[255]',
    ];

    protected $validationMessages = [
        'parent_id' => [
            'required' => '상위메뉴는 필수 입력입니다.',
        ],
        'title' => [
            'required' => '제목은 필수 입력입니다.',
            'min_length' => '제목은 최소2자입니다.',
            'max_length' => '제목은 최대120자입니다',
        ],
        'active' => [
            'required' => '활성 상태를 선택하십시오.',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;


     // 获取单条菜单
    public function getMenuById(int $id)
    {
        return $this ->select("id, parent_id, active, title, url, description, subject, open_new")
        ->find($id);
    }

    // 获取菜单
    public function getMenu(): array
    {
        return $this->select('id, title as text')
            ->orderBy('sequence', 'asc')
            ->findAll();
    }

    // 获取菜单 sequence 最大值
    public function getMaxSequence(): int
    {
        $row = $this->orderBy('sequence', 'desc')->first();
        return $row['sequence'] ?? 0;
    }
   
    // 清理缓存
    protected function deleteCacheMenu()
    {
        $cacheKey = auth()->user()->id.'_group_menu';
        cache()->delete($cacheKey);

        //清前台缓存
        foreach(config('App')->supportedLocales as $locale){
             $cacheKey = 'frontend_menu_tree_' . $locale;
             cache()->delete($cacheKey);
        }
    }

}
