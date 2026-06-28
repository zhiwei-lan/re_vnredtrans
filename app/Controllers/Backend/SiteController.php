<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Services\Backend\SiteService;
use App\Models\SiteModel;
use App\Models\SiteDomainModel;



class SiteController extends AdminBaseController
{
    use ResponseTrait;
    protected SiteModel $SiteModel;
    protected SiteDomainModel $SiteDomainModel;
    protected SiteService $SiteService;

    public function __construct()
    {
        $this->SiteModel = new SiteModel();
        $this->SiteDomainModel = new SiteDomainModel();
        $this->SiteService = new SiteService();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            return $this->respond($this->SiteService->getDataTable($this->request->getGet()));
        }

        return view('Backend/Site/index', [
            'title'    => lang('Haoadmin.site.title'),
            'subtitle' => lang('Haoadmin.site.subtitle'),
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
            return view('Backend/Site/write', [
                'title'    => lang('Haoadmin.site.title'),
            ]);
        }
        
        return view('Backend/Site/write', [
            'title'    => lang('Haoadmin.site.title'),
            'site'  => $this->SiteService->read($id)
        ]);
    }

    // 新增或修改
    public function write(int $id = null)
    {   
        $params = $this->request->getPost();
        try {
            if ($id == null) {
                //新增
                $this->SiteService->save($params);
                redirect()->back()->with('sweet-success', lang('Haoadmin.site.msg.msg_insert'));
            }else{
                //修改
                $this->SiteService->save($params,$id);
                return redirect()->back()->with('sweet-success', lang('Haoadmin.site.msg.msg_insert'));
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
        $this->SiteService->delete($id);
        return $this->respondDeleted(lang('Haoadmin.site.msg.msg_delete'));
    }
}