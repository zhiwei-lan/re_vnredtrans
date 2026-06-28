<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\NavigationModel;
use CodeIgniter\API\ResponseTrait;
use Config\Database;

/**
 * Class NavigationController.
 */
class NavigationController extends AdminBaseController
{
    use ResponseTrait;

    protected $NavigationModel;

    public function __construct()
    {
        $this->NavigationModel = new NavigationModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return \CodeIgniter\View\View | \CodeIgniter\API\ResponseTrait
     */
   public function index()
    {
        if ($this->request->isAJAX()) {
            return $this->respond(['data' => buildTree($this->NavigationModel->orderBy('sequence', 'asc')->findAll())]);
        }
        return view('Backend/Navigation/index', [
            'title'       => lang('Haoadmin.navigation.title'),
            'subtitle'    => lang('Haoadmin.navigation.subtitle'),
            'menus'       => $this->NavigationModel->orderBy('sequence', 'asc')->findAll(),
        ]);
    }

    // 新增菜单
    public function create()
    {
        $params = $this->request->getPost();
        $params['sequence'] = $this->NavigationModel->getMaxSequence() + 1 ;
        $params['open_new']  =  $this->request->getPost('open_new') ? 1 : 0 ;

        if (! $this->NavigationModel->insert($params)) {
            return redirect()->back()->withInput()->with('error', $this->NavigationModel->errors());
        }
        return redirect()->back()->with('sweet-success', lang('Haoadmin.category.msg.msg_insert'));
    }

    // 编辑单条菜单
    public function edit($id)
    {
        $found = $this->NavigationModel->getMenuById($id);
        if ($this->request->isAJAX()) {
            if (!$found) {
                return $this->failNotFound(lang('Haoadmin.menu.msg.msg_get_fail'));
            }
            return $this->respond([
                'data' => $found,
                'menu' => $this->NavigationModel->getMenu()
            ]);
        }
    }

    // 更新菜单
    public function update($id)
    {
        $params = $this->request->getPost();
        $params['open_new']  =  $this->request->getPost('open_new') ? 1 : 0 ;

        if (! $this->NavigationModel->update($id, $params)) {
            return $this->fail($this->NavigationModel->errors());
        }
        return $this->respondUpdated(lang('Haoadmin.category.msg.msg_update'));
    }

    // 删除菜单
    public function delete($id)
    {
        $db = Database::connect();
        $db->transBegin();
         try {
            //删除分类
            $this->NavigationModel->delete($id);
            //删除分类多语言
            (new \App\Models\LanguageModel())
            ->where('owner_id', $id)
            ->where('owner_type', 'navigation')
            ->delete();
            
            $db->transCommit();
            return $this->respondDeleted(lang('Haoadmin.menu.msg.msg_delete'));

        } catch (\Throwable $e) {
            $db->transRollback();
            return $this->failNotFound(lang('Haoadmin.menu.msg.msg_get_fail'));
        }
    }

    // 更新排序
    public function sort()
    {
        $items = $this->request->getJSON(true);
        if (! is_array($items)) {
            return $this->fail('Invalid payload');
        }
        $this->NavigationModel->transBegin();
        try {
            foreach ($items as $item) {
                if (! isset($item['id'])) {
                    throw new \RuntimeException('Missing id');
                }

                $this->NavigationModel->update($item['id'], [
                    'parent_id' => $item['parent_id'] ?? 0,
                    'sequence'  => $item['left'],
                ]);
            }
            $this->NavigationModel->transCommit();
        } catch (\Throwable $e) {
            $this->NavigationModel->transRollback();
            return $this->fail($e->getMessage());
        }
        return $this->respondUpdated('Success');
    }
}
