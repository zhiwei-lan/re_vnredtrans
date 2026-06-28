<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PopupModel;
use App\Services\Backend\PopupService;
use App\Services\Backend\MediaService;

/**
 * Class PopupController.
 */
class PopupController extends AdminBaseController
{
    use ResponseTrait;
    
    protected PopupService $PopupService;
    protected PopupModel $PopupModel;
    protected MediaService $MediaService;

    public function __construct()
    {
        $this->PopupService = new PopupService();
        $this->PopupModel = new PopupModel();
        $this->MediaService = new MediaService();
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
            return $this->respond($this->PopupService->getDataTable($params));
        }

        return view('Backend/Popup/index', [
            'title'    => lang('Haoadmin.popup.title'),
            'subtitle' => lang('Haoadmin.popup.subtitle'),
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
            return view('Backend/Popup/write', [
                'title'       => lang('Haoadmin.popup.add'),
                'subtitle'    => lang('Haoadmin.popup.title'),
                'data'     => null
            ]);
        }
        // 获取关联文件
        $mediaRelations = $this->MediaService->getMedia($id, 'popup');

        return view('Backend/Popup/write', [
            'title'    => lang('Haoadmin.popup.edit'),
            'subtitle' => lang('Haoadmin.popup.title'),
            'data'  => $popup = $this->PopupModel->find($id),
            'media' => $mediaRelations
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
                $this->PopupService->save($data);
                return redirect()
                    ->to(route_to('admin.popup.manage'))
                    ->with('sweet-success', lang('Haoadmin.popup.msg.msg_insert'));
            }else{
                //修改
                $this->PopupService->save($data, $id);
                return redirect()
                    ->to(route_to('admin.popup.manage'))
                    ->with('sweet-success', lang('Haoadmin.popup.msg.msg_update'));
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
            $this->PopupService->delete($id);
            return $this->respondDeleted(lang('Haoadmin.popup.msg.msg_delete'));
        } catch (\Throwable $e) {
            return redirect()
                    ->to(route_to('admin.popup.manage'))
                    ->with('sweet-error', lang('Haoadmin.popup.msg.msg_delete_error'));
        }
    }
}
