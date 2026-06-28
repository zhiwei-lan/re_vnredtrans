<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArticlesModel;
use App\Models\ArticlesLangModel;
use App\Models\CategoryModel; 
use App\Services\Backend\ArticleService;
use App\Services\Backend\MediaService;

/**
 * Class ArticleController.
 */
class ArticleController extends AdminBaseController
{
    use ResponseTrait;
    protected ArticlesModel $ArticlesModel;
    protected CategoryModel $CategoryModel;
    protected ArticleService $ArticleService;
    protected ArticlesLangModel $ArticlesLangModel;
    protected MediaService $MediaService;
    

    public function __construct()
    {
        $this->ArticlesModel = new ArticlesModel();
        $this->ArticlesLangModel = new ArticlesLangModel();
        $this->CategoryModel = new CategoryModel();
        $this->ArticleService = new ArticleService();
        $this->MediaService = new MediaService();
    }
    /**
     * 列表页
     *
     * @return mixed
     */
    public function index(int $cateId = null)
    {
        if ($this->request->isAJAX()) {
            $params = $this->request->getGet();
            return $this->response->setJSON(
                $this->ArticleService->getDataTable($params,$cateId)
            );
        }
        if($cateId){
            $category = $this->CategoryModel->find($cateId);
        }

        return view('Backend/Article/index', [
            'title'    => $category['title']??lang('Haoadmin.article.title'),
            'subtitle' => lang('Haoadmin.article.subtitle'),
            'category_id' => $cateId
        ]);
    }
    /**
     * 回收站
     *
     * @return mixed
     */
    public function recycle(int $cateId = null)
    {
        if ($this->request->isAJAX()) {
            $params = $this->request->getGet();
            $params['recycle'] = 1;
            return $this->response->setJSON(
                $this->ArticleService->getDataTable($params,$cateId)
            );
        }

        if($cateId){
            $category = $this->CategoryModel->find($cateId);
        }

        return view('Backend/Article/recycle', [
            'title'    => lang('Haoadmin.article.recycle_title'),
            'subtitle' => lang('Haoadmin.article.subtitle'),
            'category_id' => $cateId
        ]);
    }
    //恢复
    public function restore($id){
        //同步恢复 文件 多语言 等关联数据
        if (! $this->ArticlesModel->update($id,['deleted_at' => null])) {
            return $this->failNotFound(lang('Haoadmin.article.msg.msg_restore_fail'));
        }
        return $this->respondDeleted(lang('Haoadmin.article.msg.msg_restore'));
    }
    //硬删除
    public function realdelete($id){
        //同步删除 文件 多语言 等关联数据
        $this->ArticleService->deleteArticle($id);
        return $this->respondDeleted(lang('Haoadmin.article.msg.msg_delete'));
    }
    /**
     * 添加或查看
     *
     * @return mixed
     */
    public function show(int $id = null)
    {   

        //查询分类
        $categories = $this->CategoryModel
        ->orderBy('sequence', 'asc')
        ->findAll();
        //构建可用字段
        $fields = [
            'title' =>['required' => true],
            'subject' => ['required' => false],
            'description' => ['required' => false],
            'thumbnail' => ['required' => false,'width'=>500,'height'=>500],
            'gallery' => ['required' => false,'width'=>500,'height'=>500],
            'file' => ['required' => false],
            'content' => ['required' => false],
            'meta_title' => ['required' => false],
            'meta_keywords' => ['required' => false],
            'meta_description' => ['required' => false],
        ];
        //根据分类构建可用字段
        $categoryId = $this->request->getGet('category_id')??null;
        $categoryName = null;
        if($categoryId){
            foreach($categories as $key => $category){
                if($category['id'] == $categoryId ){
                    $categoryName = $category['title'];
                    if($category['use_fields']){
                        $fields = json_decode($category['use_fields'], true) ?? [];
                    }
                }
            }
        }
        
        //新增
        if(empty($id)){
            return view('Backend/Article/write', [
                'title'       => $categoryName??lang('Haoadmin.article.title'),
                'subtitle'    => lang('Haoadmin.article.add'),
                'categories' => $categories,
                'parent_cate_id' =>$categoryId,
                'fields'   => $fields,
                'data'     => null,
            ]);
        }

        //编辑
        // 获取文章数据
        $article = $this->ArticleService->ArticleDetail($id, $this->request->getGet('lang'));

        // 获取关联文件
        $mediaRelations = $this->MediaService->getMedia($id, 'article');
        

        return view('Backend/Article/write', [
            'title'    => $categoryName??lang('Haoadmin.article.title'),
            'subtitle' => lang('Haoadmin.article.edit'),
            'data'  => $article,
            'categories' => $categories,
            'parent_cate_id' =>$categoryId,
            'media'    => $mediaRelations,
            'fields'   => $fields,
        ]);
    }

    // 新增或修改
    public function write(int $id = null)
    {   
        //数据处理
        $data = $this->request->getPost();
        $data['is_main']  = $this->request->getPost('is_main') ? 1 : 0;
        $data['is_fixed'] = $this->request->getPost('is_fixed') ? 1 : 0;

        try {
            if ($id == null) {
                //新增
                $this->ArticleService->save($data);

                return redirect()
                    ->back()
                    ->with('sweet-success', lang('Haoadmin.article.msg.msg_insert'));
            }else{
                //修改
                $this->ArticleService->save($data, $id);

                return redirect()
                    ->back()
                    ->with('sweet-success', lang('Haoadmin.article.msg.msg_update'));
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with(
                'error',
                json_decode($e->getMessage(), true) ?? ['general' => $e->getMessage()]
            );
        }
    }
    //删除
    public function delete($id){
        if (! $this->ArticlesModel->delete($id)) {
            return $this->failNotFound(lang('Haoadmin.article.msg.msg_get_fail'));
        }
        return $this->respondDeleted(lang('Haoadmin.article.msg.msg_delete'));
    }
}
