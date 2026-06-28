<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LocaleFilter implements FilterInterface
{   

    protected array $supportedLocales;

    public function __construct()
    {
        // 从 App 配置读取支持语言
        $this->supportedLocales = config('App')->supportedLocales;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $path = trim($request->getUri()->getPath(), '/');
        // 去掉 index.php
        if (str_starts_with($path, 'index.php/')) {
            $path = substr($path, strlen('index.php/'));
        }
        $segments = explode('/', $path);
        $locale = $segments[0] ?? config('App')->defaultLocale;
        // 如果 URL 中的语言不受支持，则使用默认语言
        if (! in_array($locale, $this->supportedLocales)) {
            $locale = config('App')->defaultLocale;
        }

        
        $session->set('lang', $locale);
        service('language')->setLocale($locale);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 不处理
    }
}
