<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NavigationModel; 
use App\Services\Frontend\ArticleService;

/**
 * Class ArticleController.
 */
class ArticleController extends BaseController
{
    use ResponseTrait;
    protected NavigationModel $navigation;
    protected ArticleService $articleService;

    public function __construct()
    {
        $this->navigation = new NavigationModel();
        $this->articleService = new ArticleService();
    }

    //list
    public function list($cateId,$viewname)
    {
        
        $params = $this->request->getGet();
        $params['page_limit'] = 12; //每页数据条数

        $data = $this->articleService->paginateByCategories($cateId,$params);
        
        return $this->renderView('article/'.$viewname,[ 
            'articles_list'=> $data,
        ]);
    }

    //detail
    public function detail(int $navigationId, string $slug = null,int $articleId)
    {

        $article = $this->articleService->getDetailData($articleId);
        //slug不同重定向到正确slug
        if ($slug !== $article['slug']) {
            return redirect()->to("/article/{$navigationId}/detail/{$article['slug']}/{$articleId}");
        }
        //动态页面 重建active_menus结构
        $locale = service('lang')->getLocale();
        $navi = $this->navigation
            ->select([
                'navigation.title',
                'navigation.subject',
                'navigation.url',
                'navigation.parent_id',
                'navigation.id',
                'languages.title AS lang_title',
                'languages.subject AS lang_subject',
            ])
            ->join(
                'languages',
                "languages.trans_id = navigation.id 
                AND languages.trans_type = 'navigation' 
                AND languages.lang = '{$locale}'",
                'left'
            )
            ->where('navigation.id',$navigationId)
            ->first();

        service('renderer')->setVar('active_menus', $navi);
        //动态页面 重建breadcrumb结构
        service('renderer')->setVar('breadcrumb', [[
            'title' => $navi['title'],
            'lang_title' => $navi['lang_title'],
            'url' => $navi['url']
        ],[
            'title' => $article['title'],
            'lang_title' => $article['title']
        ]]);

        
        //渲染视图
        return $this->renderView('article/detail', [
            'data' => $article,
            'parent_cate' => $navigationId
        ]);

    }
}
