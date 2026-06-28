<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\UsersJoinModel;
class LoginController extends BaseController
{
    
    public function loginPhone()
    {
        return $this->renderView('auth/login_phone');
    }
    public function doLogin()
    {
    	if (!$this->request->isAJAX()) {
            return redirect()->to('/');
        }
        if (!$this->validate([
	        'user_id' => [
	            'rules' => 'required',
	            'errors' => [
	                'required' => '아이디를 입력해 주세요.'
	            ]
	        ],
	        'user_pwd' => [
	            'rules' => 'required|min_length[6]',
	            'errors' => [
	                'required'   => '비밀번호를 입력해 주세요.',
	                'min_length' => '비밀번호는 최소 6자 이상입니다.'
	            ]
	        ]
	    ])){
		    return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 202,
	            'msg'  => $this->validator->getError('user_id') 
	                      ?: $this->validator->getError('user_pwd'),
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
	    }
        $userId = trim($this->request->getPost('user_id'));
        $userPwd = trim($this->request->getPost('user_pwd'));
    	if (empty($userId) || empty($userPwd)) {
            return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 202,
                'msg'  => '아이디와 비밀번호를 입력해 주세요.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
        }
        $usersModel = new UsersModel();
        $joinModel = new UsersJoinModel();
        $user = $usersModel->where('phone', $userId)->first();
        $userJoin = $joinModel->where('user_id', $user['id'])->first();
        if (!$user&&$userJoin) {
            return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 202,
                'msg'  => '존재하지 않는 아이디입니다.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
        }
        if (!password_verify($userPwd, $userJoin['secret2'])) {
            return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 203,
                'msg'  => '비밀번호가 올바르지 않습니다.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
        }
        session()->set([
            'user_index'   => $user['id'],
            'user_name' => $user['username'],
            'user_phone' => $user['phone'],
            'isLoggedIn' => true
        ]);
        return $this->response
          ->setHeader('X-CSRF-TOKEN', csrf_hash())
          ->setJSON([
            'code' => 200,
            'msg'  => 'Login Success',
            'csrfName' => csrf_token(),
			'csrfHash' => csrf_hash()
        ]);
    }
    public function findPwd()
    {
        return $this->renderView('auth/find_pwd');
    }
    public function doFindPwd()
	{
		if (!$this->request->isAJAX()) {
	        return redirect()->to('/');
	    }
	    if (!$this->validate([
	        'user_phone' => 'required|numeric|min_length[10]',
	        'user_phone_code' => 'required',
	        'user_pwd' => 'required|min_length[6]',
	        'user_confirm_pwd' => 'required|matches[user_pwd]'
	    ])) {
		    return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 203,
	            'msg'  => $this->validator->getErrors(),
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
	    }
	    $user_phone = trim($this->request->getPost('user_phone'));
		$phone_code = trim($this->request->getPost('user_phone_code'));
		$user_pwd = trim($this->request->getPost('user_pwd'));
		$user_confirm_pwd = trim($this->request->getPost('user_confirm_pwd'));
		if ($phone_code != session()->get('verifi_code')) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 201,
	            'msg'  => '인증 코드가 잘못되었거나 만료되었습니다. 다시 보내주세요.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
	    }
	    $usersModel = new UsersModel();
	    $joinModel  = new UsersJoinModel();
	    $exists = $usersModel->where('phone', $user_phone)->select('id')->first();
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
	    session()->remove('verifi_code');
	    $hashedPassword = password_hash($user_pwd, PASSWORD_DEFAULT);
	    $joinModel->where('user_id', $exists['id'])->set(['secret2' => $hashedPassword])->update();
	    return $this->response
          ->setHeader('X-CSRF-TOKEN', csrf_hash())
          ->setJSON([
            'code' => 200,
            'msg'  => 'Success',
            'csrfName' => csrf_token(),
			'csrfHash' => csrf_hash()
        ]);
	}
    public function register()
    {
        return $this->renderView('auth/register');
    }
    public function doRegister()
	{
		if (!$this->request->isAJAX()) {
	        return redirect()->to('/');
	    }
	    if (!$this->validate([
	        'user_name' => 'required',
	        'user_phone' => 'required|numeric|min_length[10]',
	        'user_phone_code' => 'required',
	        'user_pwd' => 'required|min_length[6]',
	        'user_confirm_pwd' => 'required|matches[user_pwd]'
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
	    $userName  = trim($this->request->getPost('user_name'));
	    $userPhone = trim($this->request->getPost('user_phone'));
	    $phoneCode = trim($this->request->getPost('user_phone_code'));
	    $userPwd   = trim($this->request->getPost('user_pwd'));
	    if ($phoneCode != session()->get('verifi_code')) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 201,
	            'msg'  => '인증 코드가 잘못되었거나 만료되었습니다. 다시 보내주세요.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
	    }
	    $usersModel = new UsersModel();
	    $joinModel  = new UsersJoinModel();
	    $exists = $usersModel->where('phone', $userPhone)->select('id')->first();
	    if ($exists) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 202,
	            'msg'  => '이미 가입된 휴대폰 번호입니다. 로그인 페이지로 이동합니다.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
	    }
	    $hashedPassword = password_hash($userPwd, PASSWORD_DEFAULT);
	    $dataUser = array(
	    	'phone' => $userPhone,
	        'username' => $userName,
	        'active'=>1,
	        'created_at' => date('Y-m-d H:i:s',time())
	    );
	    $db = \Config\Database::connect();
        $db->transStart();
        $insertId = $usersModel->insert($dataUser);
    	if (!$insertId) {
	        $db->transRollback();
	        return false;
	    }
    	$dataUserJoin = [
    		'user_id' =>$insertId,
	        'secret2' => $hashedPassword,
	        'secret'  => $userPhone,
	        'type'   => 'phone_password',
	        'created_at' => date('Y-m-d H:i:s',time())
	    ];
	    $joinModel->insert($dataUserJoin);
    	$db->transComplete();
    	if ($db->transStatus() === false) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 203,
	            'msg'  => '회원가입 중 오류가 발생했습니다.',
	            'csrfName' => csrf_token(),
				'csrfHash' => csrf_hash()
	        ]);
	    }
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
    public function checkPhone()
	{
	    if (!$this->request->isAJAX()) {
	        return redirect()->to('/');
	    }
	    $phone = trim($this->request->getPost('phone'));
	    if (!$phone) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 400,
	            'msg'  => '전화번호를 입력해 주세요.',
	            'csrfName' => csrf_token(),
    			'csrfHash' => csrf_hash()
	        ]);
	    }
	    $exists = model('UsersModel')->where('phone', $phone)->select('id')->first();
	    return $this->response
	      ->setHeader('X-CSRF-TOKEN', csrf_hash())
	      ->setJSON([
	        'code' => $exists ? 202 : 200,
	        'csrfName' => csrf_token(),
    		'csrfHash' => csrf_hash()
	    ]);
	}
    public function sendCode()
	{
		if (!$this->request->isAJAX()) {
	        return redirect()->to('/');
	    }
	    $phone = trim($this->request->getPost('phone'));
	    $type  = trim($this->request->getPost('type'));
	    if (!$phone) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 201,
	            'msg'  => '전화번호를 입력해 주세요.',
	            'csrfName' => csrf_token(),
    			'csrfHash' => csrf_hash()
	        ]);
	    }
	    $usersModel = new UsersModel();
	    $userExists = $usersModel->where('phone', $phone)->select('id')->first();
	    if ($type === 'register' && $userExists) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 203,
	            'msg'  => '이미 가입된 휴대폰 번호입니다.',
	            'csrfName' => csrf_token(),
    			'csrfHash' => csrf_hash()
	        ]);
	    }
	    if ($type === 'findPwd' && !$userExists) {
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 203,
	            'msg'  => '미등록 휴대폰 번호입니다.',
	            'csrfName' => csrf_token(),
    			'csrfHash' => csrf_hash()
	        ]);
	    }
	    $code = random_int(100000, 999999);
	    $smsMessage = "[Redtrans] 인증번호\n[{$code}]를 입력해 주세요";
	    $smsType    = "S";
	    $receive    = $phone;
	    $sender     = "1600-2609";
	    $subject    = "[Redtrans] 인증번호";
	    $smsManager = service('smsManager'); 
    	$result     = $smsManager->sendSMS($smsMessage, $smsType, $receive, $sender, $subject);
    	if (isset($result['result_code']) && $result['result_code'] === "success") {
	        session()->set([
	            'verifi_code'  => $code,
	            'verifi_phone' => $phone,
	            'verifi_time'  => time()
	        ]);
	        return $this->response
	          ->setHeader('X-CSRF-TOKEN', csrf_hash())
	          ->setJSON([
	            'code' => 200,
	            'verifi_code'=> $code,
	            'csrfName' => csrf_token(),
    			'csrfHash' => csrf_hash()
	        ]);
	    }
	    return $this->response
          ->setHeader('X-CSRF-TOKEN', csrf_hash())
          ->setJSON([
            'code' => 202,
            'msg'  => '문자 발송 실패',
            'csrfName' => csrf_token(),
			'csrfHash' => csrf_hash()
        ]);
	}
	public function logout()
	{
	    session()->destroy();
	    return redirect()->to('/');
	}


}
