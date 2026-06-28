<?php

namespace App\Filters;

use CodeIgniter\Shield\Filters\SessionAuth;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CustomAuth extends SessionAuth
{
    /**
     * 重写 Before 方法
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. 如果用户已登录，直接放行
        if (auth()->loggedIn()) {
            return;
        }

        // 2. 如果未登录，
        return redirect()->to(service('lang')->getLocale().'/login'); 
    }
}