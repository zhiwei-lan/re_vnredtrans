<?php
namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table = 'forms';
    protected $allowedFields = [
        'code','name','submit_email','success_message','active','version','fields','lang'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
     protected $useSoftDeletes = true; 
    protected $deletedField = 'deleted_at';
    
    // Validation 字段验证规则
    protected $validationRules = [
        'code' => 'required|alpha_dash|min_length[3]|max_length[50]',
        'name'            => 'required|min_length[2]|max_length[255]',
        'submit_email'    => 'required|valid_email',
        'success_message' => 'required|min_length[2]|max_length[255]',
        'active'       => 'required',
        'fields'       => 'required',
    ];


    public function getByCode(string $code)
    {
        return $this->where('code', $code)
            ->where('active', 1)
            ->first();
    }
    
    /**
     * 获取 DataTable 格式的最新版本列表
     */
    public function getDataTable(array $params): array
    {
        $db = \Config\Database::connect();
        $table = $this->table;

        $start  = (int) ($params['start'] ?? 0);
        $length = (int) ($params['length'] ?? 10);
        $search = $params['search']['value'] ?? null;
        $columns = $params['columns'] ?? [];

        $orderColumnIndex = $params['order'][0]['column'] ?? 0;
        $orderDir = $params['order'][0]['dir'] ?? 'desc';
        $orderColumn = $columns[$orderColumnIndex]['data'] ?? 'id';

        // 子查询：同表内取最新版本
        $subQuery = $db->table($table)
            ->select('code, lang, MAX(version) AS version')
            ->where('deleted_at', null)
            ->groupBy(['code', 'lang'])
            ->getCompiledSelect();

        // 主查询
        $builder = $db->table($table . ' t1');

        $builder->select('t1.*');

        $builder->join(
            "({$subQuery}) t2",
            't1.code = t2.code
            AND t1.lang = t2.lang
            AND t1.version = t2.version',
            'inner'
        );

        $builder->where('t1.deleted_at', null);

        // 搜索
        if ($search) {
            $builder->groupStart()
                ->like('t1.code', $search)
                ->orLike('t1.title', $search)
                ->groupEnd();
        }

        // 统计
        $recordsTotal = $builder->countAllResults(false);

        // 排序
        $builder->orderBy('t1.' . $orderColumn, $orderDir);

        // 分页
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getResultArray();

        return [
            'draw' => (int) ($params['draw'] ?? 1),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $data,
        ];
    }

    
}
