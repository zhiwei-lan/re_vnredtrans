<?php

namespace App\Services\Backend;

use App\Models\ArticlesModel;
use App\Models\ArticlesLangModel;
use App\Services\Backend\MediaService;
use Config\Database;

class ArticleService
{
    protected ArticlesModel $ArticlesModel;
    protected ArticlesLangModel $ArticlesLangModel;
    protected MediaService $MediaService;
 
    public function __construct()
    {
        $this->ArticlesModel  = new ArticlesModel();
        $this->ArticlesLangModel = new ArticlesLangModel(); 
        $this->MediaService = new MediaService();

        helper('editor_helper');
    }
    
    /**
     * datatable形式查询
     */
     public function getDataTable(array $params , int $cateId = null): array
    {
        $start  = (int) ($params['start'] ?? 0);
        $length = (int) ($params['length'] ?? 10);
        $search = $params['search']['value'] ?? null;
        $order  = $params['order'] ?? 'id';
        $dir    = $params['dir'] ?? 'desc';
        $deleted = empty($params['recycle']) ? 0 : 1;
        $orderableFields = ['id', 'title', 'created_at'];
        if (! in_array($order, $orderableFields, true)) {
            $order = 'id';
        }

        if (! in_array($dir, ['asc', 'desc'], true)) {
            $dir = 'desc';
        }
        return [
            'data'            => $this->ArticlesModel->getDataTableData(
                $start,
                $length,
                $order,
                $dir,
                $search,
                $deleted,
                $cateId
            ),
            'recordsTotal'    => $this->ArticlesModel->countAllData($deleted,$cateId),
            'recordsFiltered' => $this->ArticlesModel->countFilteredData($search,$deleted,$cateId),
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
            // 按 allowedFields 拆数据
            $articleData = $this->filterByAllowedFields($data, $this->ArticlesModel);
            $langData    = $this->filterByAllowedFields($data, $this->ArticlesLangModel);
            // 主表主语言默认标题
            if($data['lang']===config('App')->defaultLocale){
                $articleData['default_title'] = $data['title'];
                $articleData['default_subject'] = $data['subject']??'';
                $articleData['default_description'] = $data['description']??''; 
            }
            //优化列表查询 主表存第一个缩略图
            if(!empty($data['thumbnail_image_ids'])){
                $thumbnails = explode(',',$data['thumbnail_image_ids']);
                $articleData['thumbnail_id'] = $thumbnails[0];
            }
            if ($id === null) {
                // 写文章主表
                if (! $this->ArticlesModel->insert($articleData)) {
                    throw new \RuntimeException(json_encode($this->ArticlesModel->errors()));
                }
                $articleId = $this->ArticlesModel->getInsertID();

                //写文章语言表
                $langData['article_id'] = $articleId;
                if (! $this->ArticlesLangModel->insert($langData)) {
                    throw new \RuntimeException(json_encode($this->ArticlesLangModel->errors()));
                }
            } else {
                // 更新文章主表
                if (! empty($articleData)) {
                    if (! $this->ArticlesModel->update($id, $articleData)) {
                        throw new \RuntimeException(json_encode($this->ArticlesModel->errors()));
                    }
                }
                //更新文章语言表
                // 语言表（必须按 article_id + lang）
                $langData['article_id'] = $id;

                $langRow = $this->ArticlesLangModel
                    ->where('article_id', $id)
                    ->where('lang', $langData['lang'])
                    ->first();

                if ($langRow) {
                    if (! empty($langData)) {
                        if (! $this->ArticlesLangModel->update($langRow['id'], $langData)) {
                            throw new \RuntimeException(json_encode($this->ArticlesLangModel->errors()));
                        }
                    }

                } else {
                    if (! $this->ArticlesLangModel->insert($langData)) {
                        throw new \RuntimeException(json_encode($this->ArticlesLangModel->errors()));
                    }
                }
                
                $articleId = $id;
            }
            /** ---------------- 同步媒体 ---------------- */
            $this->MediaService->syncMedia($articleId,'article', $data);

            $db->transCommit();
            return $articleId;

        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
    public function deleteArticle(int $articleId)
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            // 1. 删除关联媒体及中间表
            $this->MediaService->deleteByOwner($articleId);

            // 2. 删除文章语言表记录
            $this->ArticlesLangModel
                ->where('article_id', $articleId)
                ->delete();

            // 3. 删除文章主表记录（硬删除）
            if (! $this->ArticlesModel->builder()->where('id', $articleId)->delete()) {
                throw new \RuntimeException('Failed to delete article');
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
    public function ArticleDetail(int $articleId, string $lang = null): array
    {
        $originLang = $lang;
        if(empty($lang) || !in_array($lang,config('App')->supportedLocales)){
            $lang = config('App')->defaultLocale;
        }
        //查询语言数据是否存在
        $articleLang = $this->ArticlesLangModel
        ->where('article_id', $articleId)
        ->where('lang', $lang)
        ->first();
        if(!$articleLang){
            //不存在则使用默认语言数据
            $lang = config('App')->defaultLocale;
        }
        //查询文章主数据及语言数据

        $article = $this->ArticlesModel->getDetailWithLocale($articleId, $lang);
        

        if (! $article) {
            return [
                //默认空数据结构
                'id'               => $articleId,
                'lang'             => $originLang,
            ];
        }
        // 如果语言数据不存在 则设置语言字段为当前选择的语言
        if(!$articleLang){
            $article['lang'] = $originLang;
        }
        return $article;
    }
    private function filterByAllowedFields(array $data, $model): array
    {
        return array_intersect_key(
            $data,
            array_flip($model->allowedFields)
        );
    }
    
}
