<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class PageController extends BaseController
{
    public function page(string $page)
    {
        return $this->renderView("pages/{$page}");
    }


}
