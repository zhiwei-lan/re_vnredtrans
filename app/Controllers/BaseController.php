<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PopupModel;
use App\Models\FamilySiteModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;


    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        //language 
        $locale =  service('lang')->getLocale();
        service('language')->setLocale($locale);
        //navigation 
        $menus = frontendMenu($request->getUri()->getRoutePath());
        service('renderer')->setVar('menus', $menus);
        service('renderer')->setVar('active_menus', getCurrentMenu($menus));
        service('renderer')->setVar('breadcrumb', buildBreadcrumbFromMenus($menus) ?? []);
        //family site
        $cacheKey = 'family_site_'.$locale ;
        $cache = cache();
        $family_site = $cache->get($cacheKey);
        if ($family_site === null) {
            $family_site = (new FamilySiteModel())
            ->where('family_sites.active', 1)
            ->where('family_sites.lang', $locale)
            ->findAll();
            // 缓存 1 小时
            $cache->save($cacheKey, $family_site, 3600);
        }
        service('renderer')->setVar('family_site', $family_site ?? []);
        
    }

    protected function renderView(string $view, array $data = [])
    {
        $locale = service('lang')->getLocale();
        $agent  = service('request')->getUserAgent();
        $device = $agent->isMobile() ? 'mobile' : 'pc';
        if ($device === 'mobile') {
            $viewPath = "Frontend/mobile/{$locale}/{$view}";
        } else {
            $viewPath = "Frontend/{$locale}/{$view}";
        }
        $viewFilePath = APPPATH . 'Views/' . str_replace('/', '/', $viewPath) . '.php';
        if (!is_file($viewFilePath)) {
            $defaultLocale = config('App')->defaultLocale;
            if ($device === 'mobile') {
                $viewPath = "Frontend/mobile/{$defaultLocale}/{$view}";
            } else {
                $viewPath = "Frontend/{$defaultLocale}/{$view}";
            }
        }
        return view($viewPath, $data);
    }

}
