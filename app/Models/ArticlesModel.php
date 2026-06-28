<?php

namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class ArticlesModel extends Model
{
    protected $table = 'articles';//表名
    protected $primaryKey = 'id';//主键
    protected $useAutoIncrement = true; //主键自增
    protected $returnType = 'array'; //返回的数据类型
    protected $useSoftDeletes = true; // 开启软删除
    protected $useTimestamps = true;//自动插入创建更新时间
    //Dates
    protected $dateFormat = 'datetime';//时间类型
    protected $createdField = 'created_at';//创建时间字段
    protected $deletedField = 'deleted_at'; //用于软删除字段

    //可添加修改的字段 防止大规模赋值漏洞
    protected $allowedFields = [ 
        'default_title',
        'default_subject',
        'default_description',
        'slug',
        'excerpt',
        'thumbnail_id',
        'category_id',
        'view_count',
        'active',
        'is_main',
        'is_fixed',
        'featured',
        'published_ip',
        'sequence',
        'deleted_at',
    ];

    // Validation 字段验证规则
    protected $validationRules = [
        'default_title' => 'required|min_length[2]|max_length[255]',
        'category_id'      => 'required|integer',
        'active'           => 'required',
        'sequence'         => 'permit_empty|integer',
        'is_main'          => 'permit_empty|in_list[0,1]',
        'is_fixed'         => 'permit_empty|in_list[0,1]',
    ];
    //验证提示信息
    protected $validationMessages = [
        'default_title' => [
            'required' => '제목은 필수 입력입니다.',
            'min_length' => '제목은 최소3자입니다.',
            'max_length' => '제목은 최대120자입니다',
        ],
        'category_id' => [
            'required' => '분류를 선택하십시오.',
        ],
        'active' => [
            'required' => '활성 상태를 선택하십시오.',
        ],
    ];

    protected $skipValidation = false; //是否跳过验证
    protected $cleanValidationRules = true; //是否移除传入数据中不存在的验证规则

    // Callbacks 模型事件回调
    protected $allowCallbacks = true;
    protected $beforeInsert = ['addCreatedBy'];
    protected $afterInsert = ['generateSlug'];
    protected $beforeUpdate = ['addUpdatedBy'];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

   
    // 创建者 
    protected function addCreatedBy(array $data)
    {
        // 如果已经设置了created_by，则不覆盖
        if (!isset($data['data']['created_by']) || empty($data['data']['created_by'])) {
            // 尝试从认证系统获取用户
            $user = auth()->user();
            if ($user && isset($user->id)) {
                $data['data']['created_by'] = $user->id;
            }
            //此处只用于数据迁移 如果获取不到用户（如在CLI中），则使用系统用户ID 0
            // else {
            //     $data['data']['created_by'] = 0;
            // }
        }
        
        if (!isset($data['data']['published_ip'])) {
            $request = service('request');
            if ($request) {
                $data['data']['published_ip'] = $request->getIPAddress();
            } else {
                $data['data']['published_ip'] = '0.0.0.0';
            }
        }
        
        return $data;
    }

    // 修改者
    protected function addUpdatedBy(array $data)
    {
        // 如果已经设置了updated_by，则不覆盖
        if (!isset($data['data']['updated_by']) || empty($data['data']['updated_by'])) {
            // 尝试从认证系统获取用户
            $user = auth()->user();
            if ($user && isset($user->id)) {
                $data['data']['updated_by'] = $user->id;
            }
            //此处只用于数据迁移 如果获取不到用户（如在CLI中），则使用系统用户ID
            // else {
            //     $data['data']['updated_by'] = 0;
            // }
        }
        
        return $data;
    }
    //阅读数+1
    public function incrementViews(int $id): void
    {
        $this->allowCallbacks(false);//关闭回调 避免触发更新回调改写修改信息
        $this->builder()
            ->where('id', $id)
            ->set('view_count', 'view_count + 1', false)
            ->update();

        $this->allowCallbacks(true);
    }

    //生成slug
    protected function generateSlug(array $data)
    {
        if (!$data['result'] || !isset($data['data']['default_title'])) {
            return $data;
        }
        $title = $data['data']['default_title'];
        $insertedId = $data['id'];
        // 生成 Slug
        helper('url');
        $slug = url_title($title, '-', true);

        if (empty($slug)) {
            $slug = "post-" . $insertedId;
        }
        // 拼接 ID 避免重复
        $finalSlug = $slug . '-' . $insertedId;

        $this->update($insertedId, ['slug' => $finalSlug]);

        return $data;
    }


     protected function datatableBase()
    {
        return $this
            ->select([
                'articles.id',
                'articles.default_title',
                'articles.active',
                'articles.is_main',
                'articles.is_fixed',
                'categories.title AS category',
                'categories.id AS category_id',
                'users.username AS author',
                'articles.created_at',
            ])
            ->join('categories', 'categories.id = articles.category_id', 'left')
            ->join('users', 'users.id = articles.created_by', 'left');
    }

    /* ================== 搜索 ================== */

    protected function applySearch(?string $search): void
    {
        if (! $search) {
            return;
        }

        $this->groupStart()
            ->like('articles.default_title', $search)
            ->groupEnd();
    }

    /* ================== 数据 ================== */

    public function getDataTableData(
        int $start,
        int $length,
        string $order,
        string $dir,
        ?string $search,
        int $deleted = 0,
        int $cateId = null
    ): array {
        if($deleted){
            $this->withDeleted();
        }
        if($cateId){
            // 获取该分类及其所有子分类
            $categoryModel = model('CategoryModel');
            $categoryIds = $categoryModel->getCategoryWithChildren($cateId);
            $this->whereIn('articles.category_id', $categoryIds);
        }
       
        $this->datatableBase();
        $this->applySearch($search);
        
        if($deleted){
            $this->where('articles.deleted_at IS NOT NULL', null, false);
        }

        return $this
            ->orderBy($order, $dir)
            ->findAll($length, $start);
    }

    
    /* ================== 总数 ================== */

    public function countAllData(int $deleted,int $cateId): int
    {   
        if($cateId){
            // 获取该分类及其所有子分类
            $categoryModel = model('CategoryModel');
            $categoryIds = $categoryModel->getCategoryWithChildren($cateId);
            $this->whereIn('articles.category_id', $categoryIds);
        }
        if($deleted){
            $this->withDeleted();
            $this->where('articles.deleted_at IS NOT NULL', null, false);
        }
        return $this->countAllResults();
    }

    /* ================== 过滤后数量 ================== */

    public function countFilteredData(?string $search,int $deleted,int $cateId): int
    {
        $this->applySearch($search);
        if($cateId){
            // 获取该分类及其所有子分类
            $categoryModel = model('CategoryModel');
            $categoryIds = $categoryModel->getCategoryWithChildren($cateId);
            $this->whereIn('articles.category_id', $categoryIds);
        }
        if($deleted){
            $this->withDeleted();
            $this->where('articles.deleted_at IS NOT NULL', null, false);
        }
        return $this->countAllResults();
    }

    public function getDetailWithLocale(int $id ,string $locale): ?array
    {
        $builder = $this->withDeleted()
        ->select([
            'articles.*',
            'articles_lang.title AS title',
            'articles_lang.subject AS subject',
            'articles_lang.description AS description',
            'articles_lang.lang AS lang',
            'articles_lang.content_delta AS content_delta',
            'articles_lang.content_html AS content_html',
            'articles_lang.meta_title AS meta_title',
            'articles_lang.meta_description AS meta_description',
            'articles_lang.meta_keywords AS meta_keywords',
        ])
        ->join('articles_lang', 'articles_lang.article_id = articles.id', 'left')
        ->where('articles.id', $id)
        ->where('articles_lang.lang', $locale);
        $article = $builder->get(1)->getRow();
        return $article ? (array) $article : null;
    }

    /* ================== 文章详情 ================== */

    public function getDetail(int $id, string $locale): ?array
    {
        $this->select("
                articles.id,
                articles.default_title,
                articles.slug,
                articles_lang.title AS title,
                articles_lang.subject AS subject,
                articles_lang.description AS description,
                articles_lang.content_html AS content_html,
                articles_lang.meta_title AS meta_title,
                articles_lang.meta_description AS meta_description,
                articles_lang.meta_keywords AS meta_keywords,
                articles.view_count,
                articles.is_fixed,
                articles.created_at,
                articles.updated_at,
                articles.category_id,
                users.username AS author,
                categories.title AS default_category,
                languages.title AS category,
            ")
            // 文章多语言
            ->join(
                'articles_lang', 
                "articles_lang.article_id = articles.id 
                AND articles_lang.lang = " . $this->db->escape($locale),
                'left'
            )
            //作者
            ->join('users', 'users.id = articles.created_by', 'left')
            // 分类
            ->join('categories', 'categories.id = articles.category_id', 'left')
            // 分类语言
            ->join(
                'languages',
                'languages.trans_id = categories.id 
                AND languages.trans_type = "category" 
                AND languages.lang = ' . $this->db->escape($locale),
                'left'
            )
            ->where('articles.id', $id)
            ->where('articles.deleted_at', null)
            ->where('articles.active', 1);

        return $this->first();
    }

    /* ================== 上一篇 ================== */

    public function getPrevArticle(array $current, string $locale): ?array
    {
        return $this
            ->select('articles.id, articles.default_title, articles.slug,articles_lang.title')
            // 多语言
            ->join(
                'articles_lang', 
                "articles_lang.article_id = articles.id 
                AND articles_lang.lang = " . $this->db->escape($locale),
                'left'
            )
            ->where('articles.active', 1)
            ->where('articles.deleted_at', null)
            ->where('articles.category_id', $current['category_id'])
            ->groupStart()
                ->where('articles.created_at >', $current['created_at'])
                ->orGroupStart()
                    ->where('articles.created_at', $current['created_at'])
                    ->where('articles.id >', $current['id'])
                ->groupEnd()
            ->groupEnd()
            ->orderBy('articles.created_at', 'ASC')
            ->orderBy('articles.id', 'ASC')
            ->first();
    }

    /* ================== 下一篇 ================== */

    public function getNextArticle(array $current, string $locale): ?array
    {
        return $this
            ->select('articles.id, articles.default_title, articles.slug,articles_lang.title')
            // 多语言
            ->join(
                'articles_lang', 
                "articles_lang.article_id = articles.id 
                AND articles_lang.lang = " . $this->db->escape($locale),
                'left'
            )
            ->where('articles.active', 1)
            ->where('articles.deleted_at', null)
            ->where('articles.category_id', $current['category_id'])
            ->groupStart()
                ->where('articles.created_at <', $current['created_at'])
                ->orGroupStart()
                    ->where('articles.created_at', $current['created_at'])
                    ->where('articles.id <', $current['id'])
                ->groupEnd()
            ->groupEnd()
            ->orderBy('articles.created_at', 'DESC')
            ->orderBy('articles.id', 'DESC')
            ->first();
    }

    //获取分页列表
    public function paginateByCategories(
        array $categoryIds,
        int $perPage,
        ?string $keyword = null
    ): array {
        $locale = service('lang')->getLocale();
        $this->select('
            articles.id,
            articles.slug,
            articles.default_title,
            articles.default_subject,
            articles.default_description,
            articles.category_id,
            articles.view_count,
            articles.is_fixed,
            articles.sequence,
            articles.created_at,
            media.path AS thumbnail,
            users.username AS author,
            categories.title AS default_category,
            languages.title AS category,
            articles_lang.title AS title,
            articles_lang.content_html AS content
        ')
        // 文章多语言
        ->join(
            'articles_lang', 
            'articles_lang.article_id = articles.id 
            AND articles_lang.lang ='. $this->db->escape($locale), 
            'left'
        )
        // 缩略图
        ->join('media', 'media.id = articles.thumbnail_id', 'left')
        // 作者
        ->join('users', 'users.id = articles.created_by', 'left')
        // 分类
        ->join('categories', 'categories.id = articles.category_id', 'left')
        // 分类多语言
        ->join(
            'languages',
            'languages.trans_id = categories.id 
            AND languages.trans_type = "category" 
            AND languages.lang = ' . $this->db->escape($locale),
            'left'
        )
        ->where('articles.deleted_at', null)
        ->where('articles.active', 1)
        ->whereIn('articles.category_id', $categoryIds)
        ->orderBy('articles.is_fixed', 'DESC')
        ->orderBy('articles.sequence', 'ASC')
        ->orderBy('articles.created_at', 'DESC');

        $this->applySearch($keyword);

        return [
            'data'  => $this->paginate($perPage),
            'pager' => $this->pager,
        ];
    }



}