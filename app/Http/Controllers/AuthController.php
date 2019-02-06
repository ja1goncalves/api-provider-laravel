<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 11:14
 */

namespace App\Http\Controllers;

use App\Services\AuthService;

class AuthController extends AppController
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service  = $service;
    }

    public function getUserAuthenticated()
    {
        return $this->service->getUserByToken();
    }

    public function confirmSignUp()
    {
        return $this->service->sendConfirmSignUp();
    }

    public function signupActivate($token)
    {
        return $this->service->signupActivate($token);
    }

    public function logout(){
        return $this->service->logout();
    }
}
