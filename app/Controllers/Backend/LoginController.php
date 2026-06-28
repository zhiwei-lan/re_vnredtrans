<?php
namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use CodeIgniter\Shield\Authentication\Authenticators\Session;

class LoginController extends AdminBaseController
{
    public function LoginView()
    {
        return view('Backend/Authentication/login');
    }

    public function LoginAction()
    {
        // 已登录先退出
        if (auth()->user()) {
           auth()->logout();
        }

         /** @var Session $auth */
        $auth = auth('session')->getAuthenticator();

        $credentials = [
            'email'    => trim($this->request->getPost('email')),
            'password' => $this->request->getPost('password'),
        ];

        $remember = (bool) $this->request->getPost('remember');

        // ✅ Shield 标准登录流程
        $result = $auth->attempt($credentials, $remember);

        if (! $result->isOK()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $result->reason());
        }

        // ✅ 登录成功后安全处理
        session()->regenerate();

        // ✅ redirect 防止跳站攻击
        $redirect = $this->request->getGet('redirect');

        if ($redirect && str_starts_with($redirect, '/')) {
            return redirect()->to($redirect);
        }

        return redirect()->to(site_url('haoadmin'));
    }

}
