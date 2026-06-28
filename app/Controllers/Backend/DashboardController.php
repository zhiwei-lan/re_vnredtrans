<?php

namespace App\Controllers\Backend;

use App\Models\UsersModel;
use App\Models\ArticlesModel;
use App\Models\FormSubmitModel;

/**
 * Class DashboardController.
 */
class DashboardController extends AdminBaseController
{
    protected UsersModel $usersModel;
    protected ArticlesModel $articlesModel;
    protected FormSubmitModel $formSubmitModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->articlesModel = new ArticlesModel();
        $this->formSubmitModel = new FormSubmitModel();
    }

    public function index()
    {
        $this->cachePage(1);//缓存60分钟
        $data = [
            'title' => 'Dashboard',
            'totalMembers' => $this->usersModel->countAll(),
            'totalArticles' => $this->articlesModel->countAll(),
            'totalSubmissions' => $this->formSubmitModel->countAll(),
        ];

        return view('Backend/dashboard', $data);
    }
}
