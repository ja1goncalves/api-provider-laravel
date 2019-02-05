<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 11:14
 */

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends AppController
{
    /**
     * @var AuthService
     */
    protected $service;

    /**
     * AuthController constructor.
     * @param AuthService $service
     */
    public function __construct(AuthService $service)
    {
        $this->service  = $service;
    }

    public function getUserAuthenticated()
    {
        return $this->service->getUserByToken();
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function confirmSignUp()
    {
        return $this->service->sendConfirmSignUp();
    }

    public function signupActivate($token)
    {
        return $this->service->signupActivate($token);
    }
}
