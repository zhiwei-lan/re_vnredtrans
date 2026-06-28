<?php

namespace App\Libraries;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Shield\Entities\User;

class UserLogin
{
    /**
     * 用户登陆事件：
     *
     * @param Entity $user CodeIgniter Shield
     */
    public function handleLogin(User $user)
    {
        //log_message('info', "User ID {$user->id} logged in for site {$siteId}");
    }
}