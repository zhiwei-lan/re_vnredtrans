<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
$config = config('App', false);
$languages = implode('|', $config->supportedLocales);
service('auth')->routes($routes, ['except' => ['login','register']]); 
$locale = service('lang')->getLocale();

    $routes->get('/', 'Frontend\HomeController::index'); //首页
    $routes->group("($languages)", ['filter' => 'language'], function($routes){
        //Frontend 
        $routes->get('/', 'Frontend\HomeController::index'); //首页
        $routes->get('pages/(:any)', 'Frontend\PageController::page/$2'); //通配静态页
        //Article 
        $routes->get('article/(:num)/detail/(:any)/(:num)', 'Frontend\ArticleController::detail/$2/$3/$4');
        $routes->get('article/(:num)/(:any)', 'Frontend\ArticleController::list/$2/$3'); 
        //Form 
        $routes->get('form/(:any)', 'Frontend\FormController::show/$2');
        //需要登录鉴权的页面 
        $routes->get('mypage', 'Frontend\AuthController::mypage_userinfo', ['filter' => ['auth', 'frontendData']]); 
        
        //phone登录
        $routes->get('phone/login', 'Frontend\PhoneAuthController::index');
        $routes->get('phone/register', 'Frontend\PhoneRegisterController::index');
        $routes->get('phone/logout', 'Frontend\PhoneAuthController::logout');
        $routes->get('phone/find', 'Frontend\PhoneForgotController::index');

        //mypage
        $routes->get('mypage/userinfo', 'Frontend\AuthController::mypage_userinfo');
        $routes->get('contact/(:any)', 'Frontend\AuthController::mypage_contact/$2');
    });
    //phone登录
    $routes->post('login/doLogin', 'Frontend\LoginController::doLogin');
    $routes->post('login/checkPhone', 'Frontend\LoginController::checkPhone');
    $routes->post('login/doRegister', 'Frontend\LoginController::doRegister');
    $routes->post('login/sendCode', 'Frontend\LoginController::sendCode');
    $routes->post('login/doFindPwd', 'Frontend\LoginController::doFindPwd');
    $routes->post('login/updateUserInfo', 'Frontend\AuthController::updateUserInfo');
    
    $routes->post('phone/login', 'Frontend\PhoneAuthController::login');
    $routes->post('phone/register', 'Frontend\PhoneRegisterController::register');
    $routes->post('phone/find', 'Frontend\PhoneForgotController::find');

    $routes->post('login/email', '\CodeIgniter\Shield\Controllers\LoginController::loginAction');
    $routes->post('register', '\CodeIgniter\Shield\Controllers\RegisterController::registerAction');

    //表单提交
    $routes->post('sendform/(:any)', 'Frontend\FormController::submit/$1');
    //代理下载（避免浏览器拦截下载）
    $routes->get('download/(:num)', 'Frontend\MediaController::download/$1',['as' => 'download']);

    //sitemap.xml
    $routes->get('sitemap.xml', 'Frontend\SitemapController::index',['filter' => []]);
    //robots.txt
    $routes->get('robots.txt', 'Frontend\RobotsController::index',['filter' => []]);
    //rss feed
    $routes->get('feed.xml', 'Frontend\RssController::index',['filter' => []]);
    $routes->get('rss', 'Frontend\RssController::index',['filter' => []]);





//API
$routes->group('api', static function ($routes) {
    $routes->get('popups', 'Frontend\PopupController::show');
});

$routes->get('haoadmin/login', 'Backend\LoginController::LoginView');
$routes->post('haoadmin/login', 'Backend\LoginController::LoginAction');
//Backend 
$routes->group('haoadmin', ['filter' => ['backendGroup:admin,superadmin','backend.csrf']], static function ($routes) {
     $routes->get('/', 'Backend\DashboardController::index');
     /**
     * User
     **/
    $routes->group(
        'user',
        ['filter' => ['permission:users.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\UsersController::index',['as' => 'admin.user.manage','filter' => 'permission:users.manage']);//list
            $routes->get('manage/new', 'Backend\UsersController::new',['as' => 'admin.user.new','filter' => 'permission:users.create']); //add view
            $routes->post('manage/create', 'Backend\UsersController::create',['as' => 'admin.user.create','filter' => 'permission:users.create']);//creat
            $routes->get('manage/(:num)/edit', 'Backend\UsersController::edit/$1',['as' => 'admin.user.edit','filter' => 'permission:users.edit']);//edit view
            $routes->post('manage/(:num)/update', 'Backend\UsersController::update/$1',['as' => 'admin.user.update','filter' => 'permission:users.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\UsersController::delete/$1',['as' => 'admin.user.delete','filter' => 'permission:users.delete']);//delete
            $routes->get('profile', 'Backend\UsersController::profile'); //profile 待完善
        }
    );
    /**
     * Menu
     **/
    $routes->group(
        'menu',
        ['filter' => ['permission:menu.manage']],
        static function ($routes) {
            $routes->get('manage', 'Backend\MenuController::index',['as' => 'admin.menu.manage','filter' => 'permission:menu.manage']);//list
            $routes->post('manage/create', 'Backend\MenuController::create',['as' => 'admin.menu.create','filter' => 'permission:menu.create']);//create
            $routes->get('manage/(:num)/edit', 'Backend\MenuController::edit/$1',['as' => 'admin.menu.edit','filter' => 'permission:menu.edit']);//edit
            $routes->post('manage/(:num)/update', 'Backend\MenuController::update/$1',['as' => 'admin.menu.update','filter' => 'permission:menu.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\MenuController::delete/$1',['as' => 'admin.menu.delete','filter' => 'permission:menu.delete']);//delete
            $routes->post('manage/sort', 'Backend\MenuController::sort', ['as' => 'admin.menu.sort','filter' => 'permission:menu.sort']);//save sort
        }
    );
    /**
     * Auth logs
     **/
    $routes->get('authlogs', 'Backend\AuthLogsController::index',['filter' => 'permission:system.authlogs']);
    /**
     * Config
     **/
    $routes->group(
        'config',
        ['filter' => ['permission:config.manage']],
        static function ($routes) {
            $routes->get('edit', 'Backend\ConfigController::edit',['as' => 'admin.config.edit','filter' => 'permission:config.edit']);//edit
            $routes->post('update', 'Backend\ConfigController::update',['as' => 'admin.config.update','filter' => 'permission:config.edit']);//update
            $routes->post('testmail', 'Backend\ConfigController::testmail',['as' => 'admin.config.testmail','filter' => 'permission:config.testmail']);//update
        }
    );
    /**
     * seo
     **/
    $routes->group(
        'seo',
        ['filter' => ['permission:seo.manage']],
        static function ($routes) {
            $routes->get('edit', 'Backend\SeoController::edit',['as' => 'admin.seo.edit','filter' => 'permission:seo.edit']);//edit
            $routes->post('update', 'Backend\SeoController::update',['as' => 'admin.seo.update','filter' => 'permission:seo.edit']);//update
        }
    );
     /**
     * Category
     **/
    $routes->group(
        'category',
        ['filter' => ['permission:category.manage']],
        static function ($routes) {
            $routes->get('manage', 'Backend\CategoryController::index',['as' => 'admin.category.manage','filter' => 'permission:category.manage']);//list
            $routes->post('manage/create', 'Backend\CategoryController::create',['as' => 'admin.category.create','filter' => 'permission:category.create']);//create
            $routes->get('manage/(:num)/edit', 'Backend\CategoryController::edit/$1',['as' => 'admin.category.edit','filter' => 'permission:category.edit']);//edit
            $routes->post('manage/(:num)/update', 'Backend\CategoryController::update/$1',['as' => 'admin.category.update','filter' => 'permission:category.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\CategoryController::delete/$1',['as' => 'admin.category.delete','filter' => 'permission:category.delete']);//delete
            $routes->post('manage/sort', 'Backend\CategoryController::sort', ['as' => 'admin.category.sort','filter' => 'permission:category.sort']);//save sort
        }
    );
    /**
     * Navigation
     **/
    $routes->group(
        'navigation',
        ['filter' => ['permission:navigation.manage']],
        static function ($routes) {
            $routes->get('manage', 'Backend\NavigationController::index',['as' => 'admin.navigation.manage','filter' => 'permission:navigation.manage']);//list
            $routes->post('manage/create', 'Backend\NavigationController::create',['as' => 'admin.navigation.create','filter' => 'permission:navigation.create']);//create
            $routes->get('manage/(:num)/edit', 'Backend\NavigationController::edit/$1',['as' => 'admin.navigation.edit','filter' => 'permission:navigation.edit']);//edit
            $routes->post('manage/(:num)/update', 'Backend\NavigationController::update/$1',['as' => 'admin.navigation.update','filter' => 'permission:navigation.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\NavigationController::delete/$1',['as' => 'admin.navigation.delete','filter' => 'permission:navigation.delete']);//delete
            $routes->post('manage/sort', 'Backend\NavigationController::sort', ['as' => 'admin.navigation.sort','filter' => 'permission:navigation.sort']);//save sort
        }
    );
    /**
     * Article
     **/
    $routes->group(
        'article',
        ['filter' => ['permission:article.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\ArticleController::index',['as' => 'admin.article.manage','filter' => 'permission:article.manage']);//list
            $routes->get('manage/(:num)/list', 'Backend\ArticleController::index/$1',['as' => 'admin.article.managelist','filter' => 'permission:article.manage']);//cate list
            $routes->get('manage/new', 'Backend\ArticleController::show',['as' => 'admin.article.new','filter' => 'permission:article.create']); //add view
            $routes->get('manage/(:num)/edit', 'Backend\ArticleController::show/$1',['as' => 'admin.article.edit','filter' => 'permission:article.edit']);//edit view
            $routes->post('manage/create', 'Backend\ArticleController::write',['as' => 'admin.article.create','filter' => 'permission:article.create']);//creat
            $routes->post('manage/(:num)/update', 'Backend\ArticleController::write/$1',['as' => 'admin.article.update','filter' => 'permission:article.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\ArticleController::delete/$1',['as' => 'admin.article.delete','filter' => 'permission:article.delete']);//软删除
            $routes->get('recycle', 'Backend\ArticleController::recycle',['as' => 'admin.article.recycle','filter' => 'permission:article.recycle']);//回收站列表
            $routes->post('recycle/(:num)/delete', 'Backend\ArticleController::realdelete/$1',['as' => 'admin.article.realdelete','filter' => 'permission:article.realdelete']);//硬删除
            $routes->post('recycle/(:num)/restore', 'Backend\ArticleController::restore/$1',['as' => 'admin.article.restore','filter' => 'permission:article.restore']);//恢复
            $routes->get('recycle/(:num)/list', 'Backend\ArticleController::recycle/$1',['as' => 'admin.article.recyclelist','filter' => 'permission:article.recycle']);//回收站列表
        }
    );



    /**
     * media 文件上传与管理
     **/
    $routes->group(
        'media',
        ['filter' => ['permission:media.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\MediaController::index',['as' => 'admin.media.manage','filter' => 'permission:media.manage']);//list
            $routes->post('manage/create', 'Backend\MediaController::create',['as' => 'admin.media.create','filter' => 'permission:media.create']);//creat
            $routes->post('manage/(:num)/delete', 'Backend\MediaController::delete/$1',['as' => 'admin.media.delete','filter' => 'permission:media.delete']);//delete
        }
    );
    /**
     * 表单管理
     **/
    $routes->group(
        'form',
        ['filter' => ['permission:form.manage']],
        static function ($routes) { 
            //表单模板无法删除 因为前台提交的表单 需要根据表单模板来重建表单提交数据结构 
            //否则 历史提交表单可能出现无法重建的情况 所以表单模板只能编辑不能删除
            //更新逻辑 实际是新建模板 通过viersion版本来区分不同版本的表单模板 重构历史表单提交数据 
            $routes->get('list/(:any)', 'Backend\FormController::list/$1',['as' => 'admin.form.list','filter' => 'permission:form.manage']);//submit list
            $routes->get('read/(:any)', 'Backend\FormController::read/$1/$2',['as' => 'admin.form.read','filter' => 'permission:form.manage']);//read submit form
            $routes->get('manage', 'Backend\FormController::index',['as' => 'admin.form.manage','filter' => 'permission:form.manage']);//list
            $routes->get('manage/new', 'Backend\FormController::show',['as' => 'admin.form.new','filter' => 'permission:form.create']); //add view
            $routes->get('manage/(:num)/edit', 'Backend\FormController::show/$1',['as' => 'admin.form.edit','filter' => 'permission:form.edit']);//edit view
            $routes->post('manage/create', 'Backend\FormController::write',['as' => 'admin.form.create','filter' => 'permission:form.create']);//creat
            $routes->post('manage/(:num)/update', 'Backend\FormController::write/$1',['as' => 'admin.form.update','filter' => 'permission:form.edit']);//update
            //表单提交删除 非表单模板删除
            $routes->post('manage/(:num)/delete', 'Backend\FormController::delete/$1',['as' => 'admin.form.delete','filter' => 'permission:form.delete']);//delete
        }
    );
    /**
     * Popup 弹窗管理
     **/
    $routes->group(
        'popup',
        ['filter' => ['permission:popup.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\PopupController::index',['as' => 'admin.popup.manage','filter' => 'permission:popup.manage']);//list
            $routes->get('manage/new', 'Backend\PopupController::show',['as' => 'admin.popup.new','filter' => 'permission:popup.create']); //add view
            $routes->get('manage/(:num)/edit', 'Backend\PopupController::show/$1',['as' => 'admin.popup.edit','filter' => 'permission:popup.edit']);//edit view
            $routes->post('manage/create', 'Backend\PopupController::write',['as' => 'admin.popup.create','filter' => 'permission:popup.create']);//creat
            $routes->post('manage/(:num)/update', 'Backend\PopupController::write/$1',['as' => 'admin.popup.update','filter' => 'permission:popup.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\PopupController::delete/$1',['as' => 'admin.popup.delete','filter' => 'permission:popup.delete']);//delete
        }
    );
    /**
     * 多语言管理
     **/
    $routes->group(
        'language',
        ['filter' => ['permission:language.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\LanguageController::show',['as' => 'admin.language.manage','filter' => 'permission:language.manage']);//show
            $routes->post('manage/write', 'Backend\LanguageController::write',['as' => 'admin.language.write','filter' => 'permission:language.create']);//creat
        }
    );
    /**
     * 友情链接管理
     **/
    $routes->group(
        'family_site',
        ['filter' => ['permission:family_site.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\FamilySiteController::index',['as' => 'admin.family_site.manage','filter' => 'permission:family_site.manage']);//list
            $routes->get('manage/new', 'Backend\FamilySiteController::show',['as' => 'admin.family_site.new','filter' => 'permission:family_site.create']); //add view
            $routes->get('manage/(:num)/edit', 'Backend\FamilySiteController::show/$1',['as' => 'admin.family_site.edit','filter' => 'permission:family_site.edit']);//edit view
            $routes->post('manage/create', 'Backend\FamilySiteController::write',['as' => 'admin.family_site.create','filter' => 'permission:family_site.create']);//creat
            $routes->post('manage/(:num)/update', 'Backend\FamilySiteController::write/$1',['as' => 'admin.family_site.update','filter' => 'permission:family_site.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\FamilySiteController::delete/$1',['as' => 'admin.family_site.delete','filter' => 'permission:family_site.delete']);//delete
        }
    );
    /**
     * 幻灯片管理
     **/
    $routes->group(
        'slide',
        ['filter' => ['permission:slide.manage']],
        static function ($routes) { 
            $routes->get('manage', 'Backend\SlideController::index',['as' => 'admin.slide.manage','filter' => 'permission:slide.manage']);//list
            $routes->get('manage/new', 'Backend\SlideController::show',['as' => 'admin.slide.new','filter' => 'permission:slide.create']); //add view
            $routes->get('manage/(:num)/edit', 'Backend\SlideController::show/$1',['as' => 'admin.slide.edit','filter' => 'permission:slide.edit']);//edit view
            $routes->post('manage/create', 'Backend\SlideController::write',['as' => 'admin.slide.create','filter' => 'permission:slide.create']);//creat
            $routes->post('manage/(:num)/update', 'Backend\SlideController::write/$1',['as' => 'admin.slide.update','filter' => 'permission:slide.edit']);//update
            $routes->post('manage/(:num)/delete', 'Backend\SlideController::delete/$1',['as' => 'admin.slide.delete','filter' => 'permission:slide.delete']);//delete
        }
    );
    /**
     * 旧数据迁移
     **/
    $routes->get('dbmigration', 'Backend\DBMigrationController::index',['filter' => 'permission:system.dbmigration']);

});




