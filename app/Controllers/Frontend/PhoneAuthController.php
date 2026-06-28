<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class PhoneAuthController extends BaseController
{
    public function index()
    {
        return $this->renderView('auth_s/login_phone');
    }
    public function login()
    {
        $user_id = $this->request->getPost('user_id');
        $user_pwd = $this->request->getPost('user_pwd');
        $result = auth()->attempt([
            'phone' => $user_id,
            'password' => $user_pwd
        ]);
        if (! $result->isOK()) {
            return $this->response
              ->setHeader('X-CSRF-TOKEN', csrf_hash())
              ->setJSON([
                'code' => 202,
                'msg'  => 'Failed!',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);
        }
        return $this->response
          ->setHeader('X-CSRF-TOKEN', csrf_hash())
          ->setJSON([
            'code' => 200,
            'msg'  => 'Login Success',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }
    public function logout()
    {
        auth()->logout();
        session()->destroy();
        return redirect()->to('/');
    }
}