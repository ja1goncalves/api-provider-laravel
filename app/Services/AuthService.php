<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:55
 */

namespace App\Services;

use App\Repositories\ProviderRepository;



/**
 * Class ProviderService
 * @package App\Services
 */
class AuthService
{
    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * @var ProviderService
     */
    protected $providerService;

    /**
     * AuthService constructor.
     * @param ProviderRepository $repository
     * @param ProviderService $providerService
     */
    public function __construct(ProviderRepository $repository, ProviderService $providerService)
    {
        $this->repository  = $repository;
        $this->providerService = $providerService;
    }


    public function getUserByToken()
    {
        $user = $this->providerService->getProviderByToken();
        if(!isset($user)){
            return[
            "error" => true,
            "message" => "Usuário não encontrado!"
        ];
        }
        return $user;
    }


    public function sendConfirmSignUp()
    {
        return [
            "error" => false,
            "message" => "Cadastro confirmado com sucesso!",
        ];
    }

    public function signupActivate($token)
    {
        $provider = Provider::where('activation_token', $token)->first();
        if (!$provider) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $provider->active = true;
        $provider->activation_token = '';
        $provider->save();
        return $provider;
    }
}
