<?php

namespace App\Models;
use CodeIgniter\Model;


/**
 * Class MenuModel.
 */
class AuthLogsModel extends Model
{
    protected $table = 'auth_logins';
    protected $primaryKey = 'id';

    protected $allowedFields = ['ip_address','user_agent','id_type','identifier','user_id','date','success'];

    protected $useTimestamps = true;
    protected $createdField = 'date';

     // ⚠️ 日志一般是全局的 关闭分站过滤
    protected bool $useSiteScope = false;

    /* ================== 基础查询 ================== */

    protected function datatableBase(): self
    {
        return $this->select([
                'id',
                'user_agent',
                'id_type',
                'identifier',
                'success',
                'ip_address',
                'date',
            ]);
    }

    /* ================== 搜索 ================== */

    protected function applySearch(?string $search): void
    {
        if (! $search) {
            return;
        }

        $this->groupStart()
            ->like('ip_address', $search)
            ->orLike('user_agent', $search)
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

