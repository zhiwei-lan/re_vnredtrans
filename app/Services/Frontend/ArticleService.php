<?php

namespace App\Services\Frontend;

use App\Models\ArticlesModel;
use App\Models\CategoryModel; 
use App\Models\MediaRelationsModel;
use App\Models\ArticlesLangModel;

class ArticleService
{
    protected ArticlesModel $ArticlesModel;
    protected CategoryModel $CategoryModel;
    protected MediaRelationsModel $MediaRelationsModel;
    protected ArticlesLangModel $ArticlesLangModel;

    public function __construct()
    {
        $this->ArticlesModel = new ArticlesModel();
        $this->CategoryModel = new CategoryModel();
        $this->MediaRelationsModel = new MediaRelationsModel();
        $this->ArticlesLangModel = new ArticlesLangModel();
    }
    public function getMainCustomer(int $category_id): array
    {
        $locale = service('lang')->getLocale();
        $articles_list = $this->ArticlesModel
            ->select(['articles.id','articles.slug','articles_lang.title as title','articles.default_title','articles.category_id','articles.default_description','articles.default_subject','media.path AS thumbnail'])
            ->join(
                'articles_lang',
                'articles_lang.article_id = articles.id',
                'left'
            )
            ->join('media', 'media.id = articles.thumbnail_id', 'left')
            ->where('articles_lang.lang', $locale)
            ->where('articles.category_id', $category_id)
            ->where('articles.active', 1)
            ->orderBy('articles.created_at', 'asc')
            ->limit(5)
            ->findAll();
        
        $result['articles_list'] = $articles_list;
        return $result;
    }

     public function getDetailData(int $articleId): array
    {
        $locale = service('lang')->getLocale();
        //先查是否有对应语言的文章数据
        if (! $this->ArticlesLangModel->where('article_id', $articleId)->where('lang', $locale)->first()) {
            //无文章多语言数据则使用默认语言
            $locale = config('App')->defaultLocale;
        }
        //文章数据
        $result = $this->ArticlesModel->getDetail($articleId, $locale);
        if (! $result) {
            return [];
        }
        //文章媒体数据
        $media = $this->MediaRelationsModel
            ->select('
                media_relations.id,
                media_relations.media_id,
                media_relations.owner_type,
                media_relations.usage_type,
                media.path,
                media.original_name
            ')
            ->join('media', 'media.id = media_relations.media_id', 'left')
            ->where([
                'media_relations.owner_id'   => $articleId,
                'media_relations.owner_type' => 'article',
            ])
            ->whereIn('media_relations.usage_type', ['thumbnail', 'gallery','file'])
            ->findAll();

        /* ---------- 构建 media ---------- */
        $thumbnail = [];
        $gallery   = [];
        $file      = [];

        if (! empty($media)) {
            foreach ($media as $item) {
                $data = [
                    'path' => $item['path'],
                    'id' => $item['media_id'],
                    'original_name' => $item['original_name']
                ];

                switch (trim($item['usage_type'])) {
                    case 'thumbnail':
                        $thumbnail[] = $data;
                        break;
                    case 'gallery':
                        $gallery[] = $data;
                        break;
                    case 'file':
                        $file[] = $data;
                        break;
                }
            }
        }

        $result['thumbnail'] = $thumbnail;
        $result['gallery']   = $gallery;
        $result['file']      = $file;
        /* ---------- 上一篇 / 下一篇 ---------- */

        $result['prev_article'] = $this->ArticlesModel->getPrevArticle($result,$locale);
        $result['next_article'] = $this->ArticlesModel->getNextArticle($result,$locale);

        /* ---------- 阅读数 +1 ---------- */

        $viewedKey = 'viewed_article_' . $articleId;
        
        if (! session()->has($viewedKey)) {
            $this->ArticlesModel->incrementViews($articleId);
            session()->set($viewedKey, true);
        }

        //详情页有分类 查询出统计分类列表
        $activeCate = $this->CategoryModel->find($result['category_id']);
        //查询同级分类列表
        $categories = $this->CategoryModel->where('parent_id',$activeCate['parent_id'])->findAll();
        $result['categories'] = $categories;
        
        //查询同级分类最新文章 20条
        $articles_list = $this->ArticlesModel
            ->select(['articles.id','articles.slug','articles_lang.title as title','articles.default_title','articles.default_subject','media.path AS thumbnail'])
            ->join(
                'articles_lang',
                'articles_lang.article_id = articles.id',
                'left'
            )
            ->join('media', 'media.id = articles.thumbnail_id', 'left')
            ->where('articles_lang.lang', $locale)
            ->where('articles.category_id', $result['category_id'])
            ->where('articles.active', 1)
            ->orderBy('articles.created_at', 'asc')
            ->limit(3)
            ->findAll();
        
        $result['articles_list'] = $articles_list;

        return $result;
    }

    /**
     * 获取分页数据
     */
    public function paginateByCategories(int $cateId, array $params): array
    {
        
        $activeCate = $params['cate'] ?? null;
        $pageLimit  = (int) ($params['page_limit'] ?? 10);
        $keyword    = $params['keyword'] ?? null;


        $categoryData = $this->CategoryModel->getChildrenWithActive($cateId, $activeCate);

        if (empty($categoryData['ids'])) {
            $categoryData['ids'][] = $activeCate;
        }
        $articleData = $this->ArticlesModel->paginateByCategories(
            $categoryData['ids'],
            $pageLimit,
            $keyword
        );

        return [
            'article'    => $articleData['data'],
            'pager'      => $articleData['pager'],
            'categories' => $categoryData['list'],
            'parent_cate' => $cateId,
        ];
    }

}
