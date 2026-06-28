<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SlideModel;
use App\Models\SlideItemModel;
use App\Services\Backend\SlideService;
use App\Services\Backend\MediaService;


/**
 * Class SlideController.
 */
class SlideController extends AdminBaseController
{
    use ResponseTrait;
    
    protected SlideModel $SlideModel;
    protected SlideItemModel $SlideItemModel;
    protected SlideService $slideService;
    protected MediaService $MediaService;

    public function __construct()
    {
        $this->SlideModel = new SlideModel();
        $this->SlideItemModel = new SlideItemModel();
        $this->SlideService = new SlideService();
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
            return $this->respond($this->SlideService->getDataTable($params));
            
        }

        return view('Backend/Slide/index', [
            'title'    => lang('Haoadmin.slide.title'),
            'subtitle' => lang('Haoadmin.slide.subtitle'),
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
            return view('Backend/Slide/write', [
                'title'       => lang('Haoadmin.slide.add'),
                'subtitle'    => lang('Haoadmin.slide.title'),
                'data'     => null,
            ]);
        }

        // 获取关联文件
        $mediaRelations = $this->MediaService->getMedia($id, 'slide');
        $slide_item = $this->SlideItemModel->where('slide_id',$id)->findAll();
        if(!empty($slide_item)){
            foreach($slide_item as $i => $item){
                $mediaRelations['galleries'][$i]['id'] = $item['id'];
                $mediaRelations['galleries'][$i]['title'] = $item['title'];
                $mediaRelations['galleries'][$i]['subject'] = $item['subject'];
                $mediaRelations['galleries'][$i]['description'] = $item['description'];
                $mediaRelations['galleries'][$i]['content'] = $item['content'];
                $mediaRelations['galleries'][$i]['path'] = $item['image'];
                $mediaRelations['galleries'][$i]['video'] = $item['video'];
                $mediaRelations['galleries'][$i]['open_new'] = $item['open_new'];
            }
        }
        return view('Backend/Slide/write', [
            'title'    => lang('Haoadmin.slide.edit'),
            'subtitle' => lang('Haoadmin.slide.title'),
            'data'  => $this->SlideModel->find($id),
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
                $this->SlideService->save($data);
                return redirect()
                    ->to(route_to('admin.slide.manage'))
                    ->with('sweet-success', lang('Haoadmin.slide.msg.msg_insert'));
            }else{
                //修改
                $this->SlideService->save($data,$id);
                return redirect()
                    ->to(route_to('admin.slide.manage'))
                    ->with('sweet-success', lang('Haoadmin.slide.msg.msg_update'));
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
            $this->SlideModel->delete($id);
            return $this->respondDeleted(lang('Haoadmin.slide.msg.msg_delete'));
        } catch (\Throwable $e) {
            return redirect()
                    ->to(route_to('admin.slide.manage'))
                    ->with('sweet-error', lang('Haoadmin.slide.msg.msg_delete_error'));
        }
    }
}
