<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Events\Events;


/**
 * Class UsersController.
 */
class UsersController extends AdminBaseController
{
    use ResponseTrait;

    /** @var \App\Models\UserModel */
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAJAX()) {
            $params = $this->request->getGet();
            $start  = (int) ($params['start'] ?? 0);
            $length = (int) ($params['length'] ?? 10);
            $search = $params['search']['value'] ?? null;
            $order  = $params['order'] ?? 'id';
            $dir    = $params['dir'] ?? 'desc';

            $orderableFields = ['id', 'title', 'created_at'];

            if (! in_array($order, $orderableFields, true)) {
                $order = 'id';
            }

            if (! in_array($dir, ['asc', 'desc'], true)) {
                $dir = 'desc';
            }
            $rows = $this->usersModel->getDataTableData(
                    $start,
                    $length,
                    $order,
                    $dir,
                    $search
            );

            $result = [
                'data'            => $rows,
                'recordsTotal'    => $this->usersModel->countAllData(),
                'recordsFiltered' => $this->usersModel->countFilteredData($search),
            ];
            return $this->respond($result);
        }
        return view('Backend/User/index', [
            'title'    => lang('Haoadmin.user.title'),
            'subtitle' => lang('Haoadmin.user.subtitle'),
        ]);
    }

    /**
     * Show profile user or update.
     *
     * @return mixed
     */
    public function profile()
    {
        if ($this->request->getMethod() === 'post') {
            $id = user()->id;
            $validationRules = [
                'email'        => "required|valid_email|is_unique[users.email,id,$id]",
                'username'     => "required|alpha_numeric_space|min_length[3]|is_unique[users.username,id,$id]",
                'password'     => 'if_exist',
                'pass_confirm' => 'matches[password]',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

            $user = new User();

            if ($this->request->getPost('password')) {
                $user->password = $this->request->getPost('password');
            }

            $user->email = $this->request->getPost('email');
            $user->username = $this->request->getPost('username');

            if ($this->users->skipValidation(true)->update(user()->id, $user)) {
                return redirect()->back()->with('sweet-success', lang('Haoadmin.user.msg.msg_update'));
            }

            return redirect()->back()->withInput()->with('sweet-error', lang('Haoadmin.user.msg.msg_get_fail'));
        }

        //get current user
        $user = auth()->user();
        $data = [
            'title'       => lang('Haoadmin.user.fields.profile'),
            'user'        => $user,
        ];
        return view('Backend/User/profile',$data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return mixed
     */
    public function new()
    {
        //Getting the Current User
        $user = auth()->user();
        //get user group
        $activeGroups = $user->getGroups();
        $groups = config('AuthGroups')->groups;
        //filter hight power group
        unset($groups['superadmin']);

        return view('Backend/User/create', [
            'title'       => lang('Haoadmin.user.title'),
            'subtitle'    => lang('Haoadmin.user.add'),
            'permissions' => config('AuthGroups')->permissions,
            'roles'       => $groups,
        ]);

    }

   public function create()
    {
        // 1. validation
        $validationRules = [
            'username'     => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[auth_identities.secret]', // Shield 用 auth_identities 存 email
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()
                ->with('error', $this->validator->getErrors());
        }
        // 2. get User Provider
        /** @var UserModel $users */
        $users = auth()->getProvider();
        try {
            // 3.make user
            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);
            // 4.save user
            $users->save($user);
            // 5.get user by id
            $user = $users->findById($users->getInsertID());

            if (! $user instanceof User) {
                return redirect()->back()->withInput()
                    ->with('sweet-error', 'Failed to create user');
            }
            // 6.add permission
            $permissions = $this->request->getPost('permission');
            if($permissions){
                $user->addPermission(...$permissions);
            }
            // 7.add group
            $roles = $this->request->getPost('role');
            if( $roles){
                //get current user
                $currentuser = auth()->user();
                //get user group
                $activeGroups = $currentuser->getGroups();
                //filter hight power group
                if (in_array('admin', $activeGroups, true)) {
                    unset($roles['superadmin']);
                }elseif (in_array('developer', $activeGroups, true)){
                    unset($roles['superadmin'],$roles['admin']);
                }elseif (in_array('user', $activeGroups, true)){
                    unset($roles['superadmin'],$roles['admin'],$roles['developer']);
                }
                //add group
                $user->addGroup(...$roles);
            }else{
                //add default group
                $user->addGroup('user');
            }
            // 8. active user
            $active = $this->request->getPost('active');
            if($active){
                $user->activate();
            }
            // 9. trigger regiser event
            Events::trigger('register', $user);

        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('sweet-error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('sweet-error', $e->getMessage());
        }
        // 9. success redirect
        return redirect()->to('haoadmin/user/manage')->with('sweet-success', lang('Haoadmin.user.msg.msg_insert'));
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int id
     *
     * @return mixed
     */
    public function edit($id)
    {   
        // get User Provider
        /** @var UserModel $users */
        $users = auth()->getProvider();
        //get usre by id
        $user = $users->findById($id);
        $data = [
            'title'       => lang('Haoadmin.user.title'),
            'subtitle'    => lang('Haoadmin.user.edit'),
            'permissions' => config('AuthGroups')->permissions,
            'roles'       => config('AuthGroups')->groups,
            'permission'  => $user->getPermissions(),
            'role'        => $user->getGroups(),
            'user'        => $user,
        ];
        return view('Backend/User/update', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int id
     *
     * @return mixed
     */
    public function update($id)
    {
        //1.get User Provider
        $users = auth()->getProvider();
        $user = $users->findById($id);

        $groups = $user->getGroups();
        $isUser = in_array('user', $groups, true);

        //2.check same username
        $changeUsername = $user->username !== $this->request->getPost('username');
        //3.check same email
        $changeEmail = $user->email !== $this->request->getPost('email');

        //4.validation
        $validationRules = [
            'username'     => 'required',
            'email'        => 'required', // Shield 用 auth_identities 存 email
        ];
        if ($isUser) {
            $changePhone = $user->phone !== $this->request->getPost('phone');
            if ($changePhone) {
                $validationRules['phone'] = 'required|numeric|min_length[11]|is_unique[users.phone]';
            }
        }

        //if change usernmae add validation
        if ($changeUsername) {
            $validationRules['username'] = 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]';
        }
        //if change email add validation
        if ($changeEmail) {
            $validationRules['email'] = 'required|valid_email|is_unique[auth_identities.secret]';
        }
        //if change password add validation
        if ($this->request->getPost('password')) {
            $validationRules['password'] = 'strong_password';
            $validationRules['pass_confirm'] = 'required|matches[password]';
        }
        //run validation
        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()
                ->with('error', $this->validator->getErrors());
        }

        try {
            //5.save username
            if ($changeUsername) {
                $user->fill([
                    'username' => $this->request->getPost('username'),
                    'nickname' => $this->request->getPost('username'),
                ]);
                $users->save($user);
            }
            //6.save email
            if ($changeEmail) {
                $user->fill([
                    'email' => $this->request->getPost('email'),
                ]);
                $users->save($user);
            }

            if ($isUser) {
                if ($changePhone) {
                    $user->fill([
                        'phone' => $this->request->getPost('phone'),
                        'email' => $this->request->getPost('phone').'@phone.local',
                    ]);
                    $users->save($user);
                }
            } 


            //7.save password
            if ($this->request->getPost('password')) {
                $user->fill([
                    'password' => $this->request->getPost('password'),
                ]);
                $users->save($user);
            }
            //8.sync permissions
            $permissions = $this->request->getPost('permission');
            if($permissions){
                $user->syncPermissions(...$permissions);
            }
            //9.sync group
            $roles = $this->request->getPost('role');
            if( $roles){
                //get current user
                $currentuser = auth()->user();
                //get user group
                $activeGroups = $currentuser->getGroups();
                //filter hight power group
                if (in_array('admin', $activeGroups, true)) {
                    unset($roles['superadmin']);
                }elseif (in_array('developer', $activeGroups, true)){
                    unset($roles['superadmin'],$roles['admin']);
                }elseif (in_array('user', $activeGroups, true)){
                    unset($roles['superadmin'],$roles['admin'],$roles['developer']);
                }
                //sync group
                $user->syncGroups(...$roles);
            }else{
                //sync default group
                $user->syncGroups('user');
            }
            //10.active user
            $active = $this->request->getPost('active');
            if($active){
                //on
                $user->activate();
            }else{
                //off
                $user->deactivate();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('sweet-error', $e->getMessage());
        }
        return redirect()->back()->with('sweet-success', lang('Haoadmin.user.msg.msg_update'));
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $users = auth()->getProvider();
        $users->delete($id, true);
        //return redirect()->back()->with('sweet-success', lang('Haoadmin.user.msg.msg_delete'));
        return $this->respond(lang('Haoadmin.user.msg.msg_delete'));
    }
}
