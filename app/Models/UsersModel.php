<?php

namespace App\Models;
use CodeIgniter\Model;


class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username','phone','active','created_at','nickname'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    /* ================== 基础查询 ================== */

    protected function datatableBase(): self
    {
        return $this->select([
                'users.id',
                'users.username',
                'users.phone',
                'users.active',
                'users.kakao_id',
                'users.naver_id',
                'auth_identities.secret AS email',
                'auth_groups_users.group',
                'users.created_at',
            ])
            ->join(
                'auth_identities',
                'auth_identities.user_id = users.id',
                'left'
            )
            ->join(
                'auth_groups_users', 
                'auth_groups_users.user_id = users.id ', 
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
            ->like('username', $search)
            ->orLike('email', $search)
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
