<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
use Config\Database;

/**
 * Class Category.
 */
class CategoryController extends AdminBaseController
{
    use ResponseTrait;

    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return \CodeIgniter\View\View | \CodeIgniter\API\ResponseTrait
     */
   public function index()
    {
        if ($this->request->isAJAX()) {
            return $this->respond(['data' => buildTree($this->categoryModel->orderBy('sequence', 'asc')->findAll())]);
        }
        return view('Backend/Category/index', [
            'title'       => lang('Haoadmin.category.title'),
            'subtitle'    => lang('Haoadmin.category.subtitle'),
            'menus'       => $this->categoryModel->orderBy('sequence', 'asc')->findAll(),
        ]);
    }

    // 新增菜单
    public function create()
    {
        $params = $this->request->getPost();
        //处理数据
        $params['sequence'] = $this->categoryModel->getMaxSequence() + 1 ;
        $params['is_hot']   = $this->request->getPost('is_hot') ? 1 : 0 ;
        $params['is_main']  =  $this->request->getPost('is_main') ? 1 : 0 ;
        
        // 处理 use_fields JSON 数据
        $useFieldsJson = $this->request->getPost('use_fields');
        if (is_string($useFieldsJson)) {
            // 如果是字符串，直接保存
            $params['use_fields'] = $useFieldsJson;
        } else {
            // 如果是数组，转换为 JSON
            $params['use_fields'] = json_encode($useFieldsJson ?? []);
        }
       
        if (! $this->categoryModel->insert($params)) {
            return redirect()->back()->withInput()->with('error', $this->categoryModel->errors());
        }
        return redirect()->back()->with('sweet-success', lang('Haoadmin.category.msg.msg_insert'));
    }

    // 编辑单条菜单
    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $found = $this->categoryModel->getMenuById($id);
            if (!$found) {
                return $this->failNotFound(lang('Haoadmin.menu.msg.msg_get_fail'));
            }
            return $this->respond([
                'data' => $found,
                'menu' => $this->categoryModel->getMenu()
            ]);
        }
    }

    // 更新菜单
    public function update($id)
    {
        $params = $this->request->getPost();
        $params['is_hot']   = $this->request->getPost('is_hot') ? 1 : 0 ;
        $params['is_main']  =  $this->request->getPost('is_main') ? 1 : 0 ;
        
        // 处理 use_fields JSON 数据
        $useFieldsJson = $this->request->getPost('use_fields');
        if (is_string($useFieldsJson)) {
            // 如果是字符串，直接保存
            $params['use_fields'] = $useFieldsJson;
        } else {
            // 如果是数组，转换为 JSON
            $params['use_fields'] = json_encode($useFieldsJson ?? []);
        }
        
        if (! $this->categoryModel->update($id, $params)) {
            return $this->fail($this->categoryModel->errors());
        }
        return $this->respondUpdated(lang('Haoadmin.category.msg.msg_update'));
    }

    // 删除菜单
    public function delete($id)
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            // 删除分类
            $this->categoryModel->delete($id);

            // 删除分类多语言
            (new \App\Models\LanguageModel())
                ->where('owner_id', $id)
                ->where('owner_type', 'category')
                ->delete();

            $db->transCommit();

            return $this->respondDeleted(lang('Haoadmin.menu.msg.msg_delete'));

        } catch (\Throwable $e) {

            $db->transRollback();

            return $this->failNotFound(
                lang('Haoadmin.menu.msg.msg_get_fail')
            );
        }
    }


    // 更新排序
    public function sort()
    {

        $items = $this->request->getJSON(true);
        if (! is_array($items)) {
            return $this->fail('Invalid payload');
        }
        $this->categoryModel->transBegin();
        try {
            foreach ($items as $item) {
                if (! isset($item['id'])) {
                    throw new \RuntimeException('Missing id');
                }

                $this->categoryModel->update($item['id'], [
                    'parent_id' => $item['parent_id'] ?? 0,
                    'sequence'  => $item['left'],
                ]);
            }
            $this->categoryModel->transCommit();
        } catch (\Throwable $e) {
            $this->categoryModel->transRollback();
            return $this->fail($e->getMessage());
        }
        return $this->respondUpdated('Success');
    }
}
