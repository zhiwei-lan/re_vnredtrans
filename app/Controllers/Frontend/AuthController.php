<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\ApplyArticlesModel;
use App\Models\UsersJoinModel;
use App\Models\FormModel; 
use App\Services\Frontend\FormService;

class AuthController extends BaseController
{
   
    public function mypage_userinfo()
    {  
        $user = auth()->user();
        if (!auth()->user()) {
            return redirect()->to('/ko/phone/login');
        }
        $id = $user->id;
        $usersModel = new UsersModel();
        $singleUser = $usersModel->where('id',$id)->first();
        $data = [
            'singleUser' => $singleUser,
        ];
        return $this->renderView('mypage/mypage_userinfo',$data);
    }
    public function updateUserInfo()
    {   
        $user = auth()->user();
        if (!auth()->user()) {
            return redirect()->to('/ko/phone/login');
        }
        if (!$this->request->isAJAX()) {
            return redirect()->to('/');
        }
        if (!$this->validate([
            'user_name' => 'required',
        ])) {
            return $this->response
              ->setHeader('X-CSRF-TOKEN', csrf_hash())
              ->setJSON([
                'code' => 201,
                'msg'  => $this->validator->getErrors(),
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);
        }
        $user_index = trim($this->request->getPost('user_index'));
        $username = trim($this->request->getPost('user_name'));
        $usersModel = new UsersModel();
        $exists = $usersModel->where('id', $user_index)->first();
        if (!$exists) {
            return $this->response
              ->setHeader('X-CSRF-TOKEN', csrf_hash())
              ->setJSON([
                'code' => 202,
                'msg'  => '미등록 휴대폰 번호.',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);
        }
        $usersModel->where('id', $user_index)->set(['nickname' => $username])->update();
        return $this->response
          ->setHeader('X-CSRF-TOKEN', csrf_hash())
          ->setJSON([
            'code' => 200,
            'msg'  => 'Success',
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ]);
    }
    public function mypage_contact(string $formCode)
    {
        $user = auth()->user();
        if (!auth()->user()) {
            return redirect()->to('/ko/phone/login');
        }
        $id = $user->id;
        $usersModel = new UsersModel();
        $singleUser = $usersModel->where('id',$id)->first();
        $FormService = new FormService();
        $formdata = $FormService->getFormWithCode($formCode);
        $data = [
            'form' => $formdata,
            'form_code' => $formCode,
            'singleUser' => $singleUser,
        ];
        return $this->renderView('mypage/'.$formCode,$data);
    }

    


}
