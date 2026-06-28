<?php

namespace App\Controllers;

use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;

class AuthController extends ShieldLoginController
{
    public function login()
    {
        return parent::loginAction();
    }
}