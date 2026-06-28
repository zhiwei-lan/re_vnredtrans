<?php

namespace App\Services\Backend;

use App\Models\SlideModel;
use App\Models\SlideItemModel;
use Config\Database;
use App\Services\Backend\MediaService;

class SlideService
{
    protected SlideModel $SlideModel;
    protected SlideItemModel $SlideItemModel;
    protected MediaService $MediaService;
    public function __construct()
    {
        $this->SlideModel  = new SlideModel();
        $this->SlideItemModel  = new SlideItemModel();
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

        $orderableFields = ['id', 'code', 'created_at'];

        if (! in_array($order, $orderableFields, true)) {
            $order = 'id';
        }

        if (! in_array($dir, ['asc', 'desc'], true)) {
            $dir = 'desc';
        }
        $rows = $this->SlideModel->getDataTableData(
                $start,
                $length,
                $order,
                $dir,
                $search
        );

        return [
            'data'            => $rows,
            'recordsTotal'    => $this->SlideModel->countAllData(),
            'recordsFiltered' => $this->SlideModel->countFilteredData($search),
        ];
    }
    /**
     * 创建 / 更新文章（统一入口）
     */
    public function save(array $data, ?int $id = null): int
    {
        $db = Database::connect();
        $db->transBegin();

        $SlideItem = [];
        if (!empty($data['image'])) {
            foreach ($data['image'] as $i => $image) {
                if (empty($image)) continue;

                $SlideItem[] = [
                    'slide_id'    => $id, // 临时，新增后再修改
                    'image'       => $image,
                    'title'       => $data['titles'][$i] ?? '',
                    'subject'     => $data['subject'][$i] ?? '',
                    'description' => $data['description'][$i] ?? '',
                    'content'     => $data['content'][$i] ?? '',
                    'url'         => $data['url'][$i] ?? '',
                    'video'       => $data['video'][$i] ?? '',
                    'open_new'    => $data['open_new'][$i] ?? 0,
                ];
            }
        }

        try {
            if ($id === null) {
                // 新增 Slide 主表
                if (! $this->SlideModel->insert($data)) {
                    throw new \RuntimeException(json_encode($this->SlideModel->errors()));
                }
                $SlideId = $this->SlideModel->getInsertID();

                // 新增 SlideItem 表
                if (! empty($SlideItem)) {
                    foreach ($SlideItem as &$item) {
                        $item['slide_id'] = $SlideId;
                    }
                    if (! $this->SlideItemModel->insertBatch($SlideItem)) {
                        throw new \RuntimeException(json_encode($this->SlideItemModel->errors()));
                    }
                }

            } else {
                // 更新 Slide 主表
                if (! $this->SlideModel->update($id, $data)) {
                    throw new \RuntimeException(json_encode($this->SlideModel->errors()));
                }
                $SlideId = $id;

                // 删除旧 SlideItem
                if (! $this->SlideItemModel->deleteBySlideId($id)) {
                    throw new \RuntimeException(json_encode($this->SlideItemModel->errors()));
                }

                // 新增新 SlideItem
                if (! empty($SlideItem)) {
                    foreach ($SlideItem as &$item) {
                        $item['slide_id'] = $SlideId;
                    }
                    if (! $this->SlideItemModel->insertBatch($SlideItem)) {
                        throw new \RuntimeException(json_encode($this->SlideItemModel->errors()));
                    }
                }
            }

            // 同步媒体
            $this->MediaService->syncMedia($SlideId, 'slide', $data);

            $db->transCommit();
            return $SlideId;

        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
    /**
     * 删除
     */ 
    public function delete(int $id): bool
    {
        $db = Database::connect();
        $db->transBegin();
        try {
            if (! $this->SlideModel->delete($id)) {
                throw new \RuntimeException(json_encode($this->SlideModel->errors()));
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
