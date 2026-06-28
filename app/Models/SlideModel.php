<?php

namespace App\Models;

use CodeIgniter\Model;

class SlideModel extends Model
{
    protected $table      = 'slide';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'active','lang','autoplay','loop','delay','speed','pagination','navigation','scrollbar'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $deletedField = 'deleted_at';

    // Validation 字段验证规则
    protected $validationRules = [
        'code' => 'required|min_length[2]|max_length[255]',
    ];

    protected $afterInsert = ['deleteCache'];
    protected $afterUpdate = ['deleteCache'];
    protected $afterDelete = ['deleteCache'];

    /* ================== 基础查询 ================== */

    protected function datatableBase(): self
    {
        return $this->select([
            'id',
            'code',
            'lang',
            'active',
            'created_at',
        ]);
    }

    /* ================== 搜索 ================== */

    protected function applySearch(?string $search): void
    {
        if (! $search) {
            return;
        }

        $this->groupStart()
            ->like('code', $search)
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
            //$cacheKey = 'family_site_' . $locale;
            //cache()->delete($cacheKey);
        }
    }
        
}