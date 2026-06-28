<?php

namespace App\Models;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';

    protected $returnType = 'array'; 

    protected $allowedFields = [
        'parent_id', 'active', 'title', 'icon', 'route', 'sequence', 'permission'
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
        'icon'      => 'required|min_length[5]|max_length[55]',
        'route'     => 'required|max_length[255]',
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
        'icon' => [
            'required' => '아이콘은 필수 입력입니다.',
        ],
        'route' => [
            'required' => '라우트는 필수 입력입니다.',
        ],
        'active' => [
            'required' => '활성 상태를 선택하십시오.',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;


    // get single menu by id
    public function getMenuById(int $id)
    {
        return $this->db->DBDriver === 'Postgre'
            ? $this->getMenuDriverPostgre($id)
            : $this->getMenuDriverMySQLi($id);
    }

    // get data for select2
    public function getMenu(): array
    {
        return $this->db->table('menu')
            ->select('id, title as text')
            ->orderBy('sequence', 'asc')
            ->get()
            ->getResultArray();
    }


    // MySQL 查询
    private function getMenuDriverMySQLi(int $id)
    {
        return $this->db->table('menu')
            ->select("id, parent_id, active, title, icon, route, permission")
            ->where('id', $id)
            ->get()
            ->getRowArray(); // 返回数组
    }

    // PostgreSQL 查询
    private function getMenuDriverPostgre(int $id)
    {
        return $this->db->table('menu')
            ->select("id, parent_id, active, title, icon, route, permission")
            ->where('id', $id)
            ->groupBy(['id'])
            ->get()
            ->getRowArray(); // 返回数组
    }

    // 清理缓存
    protected function deleteCacheMenu()
    {
        $cacheKey = auth()->user()->id.'_group_menu';
        if (cache($cacheKey)) {
            cache()->delete($cacheKey);
        }
    }

    // 获取菜单 sequence 最大值
    public function getMaxSequence(): int
    {
        $row = $this->selectMax('sequence')->get()->getRowArray();
        return $row['sequence'] ?? 0;
    }
}
