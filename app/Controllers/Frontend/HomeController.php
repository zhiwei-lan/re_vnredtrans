<?php
namespace App\Controllers\Frontend;
use App\Controllers\BaseController;
use App\Services\Frontend\SlideService;
use App\Services\Frontend\FormService;
use App\Services\Frontend\ArticleService;

class HomeController extends BaseController
{

    protected SlideService $SlideService; //通用幻灯片服务层
    protected FormService $FormService; //通用表单服务层
    protected ArticleService $ArticleService;

    public function __construct()
    {
        $this->SlideService = new SlideService();
        $this->FormService = new FormService();
        $this->ArticleService = new ArticleService();
    }

    public function index(): string
    {
        $data = [
            'main_top_banner' => $this->SlideService->getSlideWithCode('PC_Main_Banner'),
            'customer_list' => $this->ArticleService->getMainCustomer($category_id = 97),
        ];
        return $this->renderView('home', $data);
    }
    
}

