<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\MenuModel;
use CodeIgniter\API\ResponseTrait;

class MenuController extends AdminBaseController
{
    use ResponseTrait;

    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    // 列表
    public function index()
    {
        if ($this->request->isAJAX()) {
            return $this->respond(['data' => buildTree($this->menuModel->orderBy('sequence', 'asc')->findAll())]);
        }
        //权限列表
        $menuPermissions = array_filter(
            config('AuthGroups')->permissions,
            fn($key) => str_starts_with($key, 'menu.show.'),
            ARRAY_FILTER_USE_KEY
        );
        return view('Backend/Menu/index', [
            'title'       => lang('Haoadmin.menu.title'),
            'subtitle'    => lang('Haoadmin.menu.subtitle'),
            'permissions' => $menuPermissions,
            'menus'       => $this->menuModel->orderBy('sequence', 'asc')->findAll(),
        ]);
    }

    // 新增菜单
    public function create()
    {
        $params = $this->request->getPost();
        $params['sequence'] = $this->menuModel->getMaxSequence() + 1 ;
        if (! $this->menuModel->insert($params)) {
            return redirect()->back()->withInput()->with('error', $this->menuModel->errors());
        }
        return redirect()->back()->with('sweet-success', lang('Haoadmin.menu.msg.msg_insert'));
    }

    // 编辑单条菜单
    public function edit($id)
    {
        $found = $this->menuModel->getMenuById($id);
        if ($this->request->isAJAX()) {
            if (!$found) {
                return $this->failNotFound(lang('Haoadmin.menu.msg.msg_get_fail'));
            }
            return $this->respond([
                'data' => $found,
                'menu' => $this->menuModel->getMenu()
            ]);
        }
    }

    // 更新菜单
    public function update($id)
    {
        if (! $this->menuModel->update($id, $this->request->getPost())) {
            return $this->fail($this->menuModel->errors());
        }
        return $this->respondUpdated(lang('Haoadmin.menu.msg.msg_update'));
    }

    // 删除菜单
    public function delete($id)
    {
        if (! $this->menuModel->delete($id)) {
            return $this->failNotFound(lang('Haoadmin.menu.msg.msg_get_fail'));
        }

        return $this->respondDeleted(lang('Haoadmin.menu.msg.msg_delete'));
    }

    // 更新排序
    public function sort()
    {
        $items = $this->request->getJSON(true);
        if (! is_array($items)) {
            return $this->fail('Invalid payload');
        }
        $this->menuModel->transBegin();
        try {
            foreach ($items as $item) {
                if (! isset($item['id'])) {
                    throw new \RuntimeException('Missing id');
                }

                $this->menuModel->update($item['id'], [
                    'parent_id' => $item['parent_id'] ?? 0,
                    'sequence'  => $item['left'],
                ]);
            }
            $this->menuModel->transCommit();
        } catch (\Throwable $e) {
            $this->menuModel->transRollback();
            return $this->fail($e->getMessage());
        }
        return $this->respondUpdated('Success');
    }
}
