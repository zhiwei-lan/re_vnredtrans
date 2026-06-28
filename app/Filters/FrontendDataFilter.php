<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\NavigationModel;

class FrontendDataFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 前台导航数据
        $menus = frontendMenu($request->getUri()->getRoutePath());
        service('renderer')->setVar('menus', $menus);
        service('renderer')->setVar('active_menus', getCurrentMenu($menus));
        service('renderer')->setVar('breadcrumb', buildBreadcrumbFromMenus($menus) ?? []);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}