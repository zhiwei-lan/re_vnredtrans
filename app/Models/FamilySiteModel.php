<?php

namespace App\Models;

use CodeIgniter\Model;

class FamilySiteModel extends Model
{
    protected $table      = 'family_sites';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'url','active','lang','open_new'];
    protected $useTimestamps = true;

    // Validation 字段验证规则
    protected $validationRules = [
        'title' => 'required|min_length[2]|max_length[255]',
        'url' => 'required|valid_url',
    ];

    protected $afterInsert = ['deleteCache'];
    protected $afterUpdate = ['deleteCache'];
    protected $afterDelete = ['deleteCache'];

    /* ================== 基础查询 ================== */

    protected function datatableBase(): self
    {
        return $this->select([
            'id',
            'lang',
            'title',
            'url',
            'active'
        ]);
    }

    /* ================== 搜索 ================== */

    protected function applySearch(?string $search): void
    {
        if (! $search) {
            return;
        }

        $this->groupStart()
            ->like('title', $search)
            ->groupEnd();
    }
    
    /* ================== 数据 ================== */

    public function getDataTableData(
        int $start,
        int $length,
        string $order,
        string $dir,
        ?string $search
    ): array {
        $this->datatableBase();
        $this->applySearch($search);

        return $this
            ->orderBy($order, $dir)
            ->findAll($length, $start);
    }

    /* ================== 总数 ================== */

    public function countAllData(): int
    {
        return $this->countAllResults();
    }

    /* ================== 过滤后数量 ================== */

    public function countFilteredData(?string $search): int
    {
        $this->applySearch($search);
        return $this->countAllResults();
    }

    // 清理缓存
    protected function deleteCache()
    {
        foreach (config('App', false)->supportedLocales as $locale) {
            $cacheKey = 'family_site_' . $locale;
            cache()->delete($cacheKey);
        }
    }
        
}