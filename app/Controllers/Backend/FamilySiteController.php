<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FamilySiteModel;

/**
 * Class FamilySiteController.
 */
class FamilySiteController extends AdminBaseController
{
    use ResponseTrait;
    
    protected FamilySiteModel $FamilySiteModel;

    public function __construct()
    {
        $this->FamilySiteModel = new FamilySiteModel();
    }

    /**
     * 列表页
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $params = $this->request->getGet();
            $start  = (int) ($params['start'] ?? 0);
            $length = (int) ($params['length'] ?? 10);
            $search = $params['search']['value'] ?? null;
            $order  = $params['order'] ?? 'id';
            $dir    = $params['dir'] ?? 'desc';

            $orderableFields = ['id', 'title', 'created_at'];

            if (! in_array($order, $orderableFields, true)) {
                $order = 'id';
            }

            if (! in_array($dir, ['asc', 'desc'], true)) {
                $dir = 'desc';
            }
            $rows = $this->FamilySiteModel->getDataTableData(
                    $start,
                    $length,
                    $order,
                    $dir,
                    $search
            );

            return $this->respond([
                'data'            => $rows,
                'recordsTotal'    => $this->FamilySiteModel->countAllData(),
                'recordsFiltered' => $this->FamilySiteModel->countFilteredData($search),
            ]);
        }

        return view('Backend/FamilySite/index', [
            'title'    => lang('Haoadmin.family_site.title'),
            'subtitle' => lang('Haoadmin.family_site.subtitle'),
        ]);
    }
    /**
     * 添加或查看
     *
     * @return mixed
     */
    public function show(int $id = null)
    {   
        if(empty($id)){
            return view('Backend/FamilySite/write', [
                'title'       => lang('Haoadmin.family_site.add'),
                'subtitle'    => lang('Haoadmin.family_site.title'),
                'data'     => null
            ]);
        }

        return view('Backend/FamilySite/write', [
            'title'    => lang('Haoadmin.family_site.edit'),
            'subtitle' => lang('Haoadmin.family_site.title'),
            'data'  => $family = $this->FamilySiteModel->find($id),
        ]);
    }

    // 新增或修改
    public function write(int $id = null)
    {   
        //数据处理
        $data = $this->request->getPost();

        try {
            if ($id == null) {
                //新增
                $this->FamilySiteModel->save($data);
                return redirect()
                    ->to(route_to('admin.family_site.manage'))
                    ->with('sweet-success', lang('Haoadmin.family_site.msg.msg_insert'));
            }else{
                //修改
                $data['id'] = $id;
                $this->FamilySiteModel->save($data);
                return redirect()
                    ->to(route_to('admin.family_site.manage'))
                    ->with('sweet-success', lang('Haoadmin.family_site.msg.msg_update'));
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
        try {
            $this->FamilySiteModel->delete($id);
            return $this->respondDeleted(lang('Haoadmin.family_site.msg.msg_delete'));
        } catch (\Throwable $e) {
            return redirect()
                    ->to(route_to('admin.family_site.manage'))
                    ->with('sweet-error', lang('Haoadmin.family_site.msg.msg_delete_error'));
        }
    }
}
