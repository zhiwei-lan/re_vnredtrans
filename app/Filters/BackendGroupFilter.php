<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BackendGroupFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = auth()->user();

        // 未登录
        if (! $user) {
            return $this->handleUnauthorized($request);
        }

        // group 校验
        if ($arguments) {
            $check = false;
            foreach ($arguments as $group) {
                if ($user->inGroup($group)) {
                    $check = true;
                    break;
                }
            }
            if (!$check) {
                return $this->handleForbidden($request);
            }
        }
    }

    protected function handleUnauthorized(RequestInterface $request)
    {
        $uri = uri_string();
        $loginUrl = site_url('haoadmin/login?redirect=' . urlencode($uri));

        if ($request->isAJAX()) {
            // AJAX 返回 JSON
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['messages' => ['error' => 'Unauthorized', 'login' => $loginUrl]]);
        }

        // 普通请求跳转登录
        return redirect()->to($loginUrl);
    }

    protected function handleForbidden(RequestInterface $request)
    {
        if ($request->isAJAX()) {
            return service('response')
                ->setStatusCode(403)
                ->setJSON(['messages' => ['error' => lang('Auth.noPermission')]]);
        }

        return redirect()->back()->with('sweet-error', lang('Auth.noPermission'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 不需要处理
    }
}
