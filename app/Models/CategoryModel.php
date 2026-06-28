<?php

namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $returnType = 'array'; 

    protected $allowedFields = [
        'parent_id', 'active', 'title', 'icon','use_fields', 'sequence','is_hot','is_main','subject','description'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Trigger
    protected $afterInsert = [];
    protected $afterUpdate = [];
    protected $afterDelete = [];

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
        return $this->select("id, parent_id,use_fields, active, title, icon, is_hot, is_main, description, subject")
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
    //分类 + active 标记
    public function getChildrenWithActive(
        int $parentId,
        ?int $activeId
    ): array {

        $locale = service('lang')->getLocale();

        $cacheKey = 'category'.$locale . $parentId;
        $cache = cache();
        $categories = $cache->get($cacheKey);
        
        if ($categories === null) {
            $categories = $this
             ->select([
                'categories.title',
                'categories.id',
                'categories.sequence',
                'categories.active',
                'languages.title AS lang_title',
            ])
            ->join(
                'languages',
                "languages.trans_id = categories.id 
                AND languages.trans_type = 'category' 
                AND languages.lang = '{$locale}'",
                'left'
            )
            ->where('categories.active', 1)
            ->where('categories.parent_id', $parentId)
            ->orderBy('categories.sequence', 'ASC')
            ->findAll();
            // 缓存 1 小时
            $cache->save($cacheKey, $categories, 3600);
        }


        if (! $categories) {
            return [
                'list' => [],
                'ids'  => [$parentId],
            ];
        }
        
        $ids = [];

        foreach ($categories as &$category) {
            if ($activeId) {
                $category['active'] = ((int)$category['id'] === $activeId);
                if ($category['active']) {
                    $ids[] = $category['id'];
                }
            } else {
                $ids[] = $category['id'];
                $category['active'] = false;
            }
        }
        unset($category);
        return [
            'list' => $categories,
            'ids'  => $ids,
        ];
    }

    /**
     * 获取分类及其所有子分类的ID列表
     * @param int $categoryId 分类ID
     * @return array 分类ID数组（包括父分类本身）
     */
    public function getCategoryWithChildren(int $categoryId): array
    {
        $categories = [$categoryId];
        
        // 获取该分类的所有子分类
        $children = $this->where('parent_id', $categoryId)->findAll();
        
        foreach ($children as $child) {
            // 递归获取子分类的子分类
            $subChildren = $this->getCategoryWithChildren($child['id']);
            $categories = array_merge($categories, $subChildren);
        }
        
        return $categories;
    }
}
