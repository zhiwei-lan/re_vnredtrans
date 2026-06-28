<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
//use App\Models\PhoneCodeModel;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Events\Events;

class PhoneRegisterController extends BaseController
{
    public function index()
    {
        return $this->renderView('auth_s/register_phone');
    }

    public function register()
    {
        $rules = [
            'user_phone' => 'required|is_unique[users.phone]',
            'user_pwd' => 'required|min_length[8]',
            'user_confirm_pwd' => 'required|matches[user_pwd]',
            'user_phone_code' => 'required'
        ];
        if (! $this->validate($rules)) {
            return $this->response
              ->setHeader('X-CSRF-TOKEN', csrf_hash())
              ->setJSON([
                'code' => 202,
                'msg'  => $this->validator->getErrors(),
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);
        }
        $phone = $this->request->getPost('user_phone');
        $code  = $this->request->getPost('user_phone_code');
       
        if ($code != session()->get('verifi_code')) {
            return $this->response
              ->setHeader('X-CSRF-TOKEN', csrf_hash())
              ->setJSON([
                'code' => 201,
                'msg'  => '인증 코드가 잘못되었거나 만료되었습니다. 다시 보내주세요.',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);
        }
        $users = model(UserModel::class);
        $user = new \CodeIgniter\Shield\Entities\User([
            'nickname'=>$this->request->getPost('user_name'),
            'phone' => $phone,
            'email' => $phone . '@phone.local',
            'password' => $this->request->getPost('user_pwd'),
        ]);
        $users->save($user);
        $user = $users->findById($users->getInsertID());
        $users->addToDefaultGroup($user);
        Events::trigger('register', $user);
        $user->activate();
        auth()->login($user);
        session()->remove('verifi_code');
        return $this->response
          ->setHeader('X-CSRF-TOKEN', csrf_hash())
          ->setJSON([
            'code' => 200,
            'msg'  => 'Register Success',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }
}