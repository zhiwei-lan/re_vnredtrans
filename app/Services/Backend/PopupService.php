<?php

namespace App\Services\Backend;

use App\Models\PopupModel;
use Config\Database;
use App\Services\Backend\MediaService;

class PopupService
{
    protected PopupModel $PopupModel;
    protected MediaService $MediaService;
    public function __construct()
    {
        $this->PopupModel  = new PopupModel();
        $this->MediaService = new MediaService();
    }
    
    /**
     * datatable形式查询
     */
     public function getDataTable(array $params): array
    {
        $start  = (int) ($params['start'] ?? 0);
        $length = (int) ($params['length'] ?? 10);
        $search = $params['search']['value'] ?? null;
        $order  = $params['order'] ?? 'id';
        $dir    = $params['dir'] ?? 'desc';

        $orderableFields = ['id', 'title', 'created_at'];

        if (! in_array($order, $orderableFields, true)) {
            $order = 'id';
        }

        if (! in_array($dir, ['asc', 'desc'], true)) {
            $dir = 'desc';
        }
        $rows = $this->PopupModel->getDataTableData(
                $start,
                $length,
                $order,
                $dir,
                $search
        );

        return [
            'data'            => $rows,
            'recordsTotal'    => $this->PopupModel->countAllData(),
            'recordsFiltered' => $this->PopupModel->countFilteredData($search),
        ];
    }
    /**
     * 创建 / 更新文章（统一入口）
     */
    public function save(array $data, ?int $id = null): int
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            /** ---------------- 写文章主表 ---------------- */
            if ($id === null) {
                // CREATE
                if (! $this->PopupModel->insert($data)) {
                    throw new \RuntimeException(json_encode($this->PopupModel->errors()));
                }
                $PopupId = $this->PopupModel->getInsertID();
            } else {
                // UPDATE
                if (! $this->PopupModel->update($id, $data)) {
                    throw new \RuntimeException(json_encode($this->PopupModel->errors()));
                }
                $PopupId = $id;
            }
            /** ---------------- 同步媒体 ---------------- */
            $this->MediaService->syncMedia($PopupId,'popup', $data);

            $db->transCommit();
            return $PopupId;

        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
    /**
     * 删除弹窗
     */ 
    public function delete(int $id): bool
    {
        $db = Database::connect();
        $db->transBegin();
        try {
            if (! $this->PopupModel->delete($id)) {
                throw new \RuntimeException(json_encode($this->PopupModel->errors()));
            }
            /** ---------------- 同步删除媒体 ---------------- */
            $this->MediaService->deleteByOwner($id);

            $db->transCommit();
            return $id;

        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
}
