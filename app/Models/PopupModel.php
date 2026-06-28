<?php

namespace App\Models;

use CodeIgniter\Model;

class PopupModel extends Model
{
    protected $table      = 'popups';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content','link','active','height','width','location','offset_left','offset_top', 'show_once', 'start_at', 'end_at','lang','open_new'];
    protected $useTimestamps = true;

    // Validation 字段验证规则
    protected $validationRules = [
        'title' => 'required|min_length[2]|max_length[255]',
    ];

    // Trigger
    protected $afterInsert = ['deleteCache'];
    protected $afterUpdate = ['deleteCache'];
    protected $afterDelete = ['deleteCache'];


    /* ================== 基础查询 ================== */

    protected function datatableBase(): self
    {
        return $this->select([
            'id',
            'title',
            'active',
            'lang',
            'content',
            'start_at',
            'end_at',
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
            ->like('title', $search)
            ->orLike('content', $search)
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

    /* ================== 根据语言获取popup ================== */

    public function getPopupForLocale(string $locale): array
    {   
        $locale = service('lang')->getLocale();
        $cacheKey = 'popup_'.$locale;
        $cache = cache();
        $popup = $cache->get($cacheKey);
        
        if ($popup === null) {
            $popup = $this->select("
                popups.id,
                popups.title,
                popups.content,
                popups.show_once,
                popups.location,
                popups.start_at,
                popups.end_at,
                popups.active,
                popups.offset_left,
                popups.offset_top,
                popups.created_at,
                popups.height,
                popups.width,
                popups.lang,
                popups.open_new,
                popups.link,
                GROUP_CONCAT(
                    CONCAT(
                        media.path, '###',
                        IFNULL(media.original_name, ''), '###',
                        media_relations.usage_type
                    )
                ) AS media_data
            ")
            ->join('media_relations', 'media_relations.owner_id = popups.id AND media_relations.owner_type = "popup"', 'left')
            ->join('media', 'media.id = media_relations.media_id', 'left')
            ->where('popups.active', 1)
            ->where('popups.lang', $locale)
            ->where('popups.start_at <=', date('Y-m-d'))
            ->where('popups.end_at >=', date('Y-m-d'))
            ->orderBy('popups.created_at', 'DESC')
            ->groupBy('popups.id')
            ->findAll();
            // 缓存 60 分钟
            $cache->save($cacheKey, $popup, 3600);
        }

        return $popup;
    }

    // 清理缓存
    protected function deleteCache()
    {   
        $locale = service('lang')->getLocale();
        $cacheKey = 'popup_'.$locale;
        cache()->delete($cacheKey);
    }
}