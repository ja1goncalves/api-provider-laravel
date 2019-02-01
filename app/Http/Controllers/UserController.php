<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 11:14
 */

namespace App\Http\Controllers;

//use App\Http\Requests\ChangePasswordRequest;
//use App\Http\Requests\ConfirmPasswordResetRequest;
//use App\Http\Requests\ForgotPasswordRequest;
//use App\Http\Requests\UserRegisterRequest;
//use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends AppController
{
//    /**
//     * @var UserService
//     */
//    protected $service;
//
//
//    /**
//     * UsersController constructor.
//     * @param UserService $service
//     */
//    public function __construct(UserService $service)
//    {
//        $this->service  = $service;
//    }
//
//    /**
//     * @param Request $request
//     * @return array
//     * @throws \Exception
//     */
//    public function getUserAuthenticated(Request $request)
//    {
//        return $this->service->getUserByToken($request->header('Authorization'));
//    }
//
//    /**
//     * @param UserUpdateRequest $request
//     * @return array
//     * @throws \Exception
//     */
//    public function update(UserUpdateRequest $request)
//    {
//        return $this->service->updateUserByUsername($request->get('username'), $request->all());
//    }
//
//    /**
//     * @param UserRegisterRequest $request
//     * @return array
//     * @throws \Exception
//     */
//    public function register(UserRegisterRequest $request)
//    {
//        return $this->service->registerUser($request->all());
//    }
//
//    /**
//     * @param ForgotPasswordRequest $request
//     * @return array
//     * @throws \Exception
//     */
//    public function forgotPassword(ForgotPasswordRequest $request)
//    {
//        return $this->service->sendForgotPassword($request->get('username'));
//    }
//
//    /**
//     * @param ConfirmPasswordResetRequest $request
//     * @return array
//     * @throws \Exception
//     */
//    public function confirmPasswordReset(ConfirmPasswordResetRequest $request)
//    {
//        return $this->service->sendConfirmPasswordReset($request->all());
//    }
//
//    /**
//     * @param Request $request
//     * @return array|\Illuminate\Http\JsonResponse
//     * @throws \Exception
//     */
//    public function confirmSignUp(Request $request)
//    {
//        return $this->service->sendConfirmSignUp($request->all());
//    }
}
