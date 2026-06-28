<?php
namespace App\Models;

use CodeIgniter\Model;

class FormSubmitModel extends Model
{
    protected $table = 'form_submit';
    protected $allowedFields = [
        'form_code','data','ip','user_agent','version','view_count','lang','created_by','send_status'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';



     /* ================== 基础查询 ================== */

    protected function datatableBase(): self
    {
        return $this->select([
                'form_submit.id',
                'form_submit.lang',
                'form_submit.created_by',
                'form_submit.form_code',
                'form_submit.user_agent',
                'form_submit.ip',
                'form_submit.created_at',
                'form_submit.data',
                'form_submit.view_count',
                'form_submit.send_status',
                'users.username as author',
            ])
            ->join(
                'users',
                'users.id = form_submit.created_by',
                'left'
            );
    }

    /* ================== 搜索 ================== */

    protected function applySearch(?string $search): void
    {
        if (! $search) {
            return;
        }

        $this->groupStart()
            ->like('data', $search)
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

    
}
