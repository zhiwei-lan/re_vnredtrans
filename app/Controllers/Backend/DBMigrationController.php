<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\OldArticleModel;

/**
 * Class DBMigrationController.
 */
class DBMigrationController extends AdminBaseController
{
    protected OldArticleModel $OldArticleModel;

    public function __construct()
    {
        $this->OldArticleModel = new OldArticleModel();
    }

    
    public function index()
    {
        $oldArticles = $this->OldArticleModel
        ->select(['article_title','category_index','article_image','article_big_image','article_content'])
        ->where('category_index', 10)->findAll();
        dd($oldArticles);

        return view('backend/dbmigration/index');
    }

}
