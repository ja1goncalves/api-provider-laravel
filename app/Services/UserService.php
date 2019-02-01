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
class UserService
{

//    /**
//     * @var CognitoClient
//     */
//    protected $client;
//
//    /**
//     * @var ProviderRepository
//     */
//    protected $repository;
//
//    /**
//     * @var ProviderService
//     */
//    protected $providerService;
//
//    /**
//     * UserService constructor.
//     * @param ProviderRepository $repository
//     * @param CognitoClient $client
//     * @param ProviderService $providerService
//     */
//    public function __construct(ProviderRepository $repository, CognitoClient $client, ProviderService $providerService)
//    {
//        $this->repository  = $repository;
//        $this->client      = $client;
//        $this->providerService = $providerService;
//    }
//
//    /**
//     * @param $username
//     * @param bool $provider
//     * @return array|mixed
//     * @throws \Exception
//     */
//    public function getUserByUsername($username, $provider = false)
//    {
//        if($provider) {
//            $user = $this->repository->findByField('email', $username, ['id', 'email', 'name'])->first();
//        } else {
//            $user = $this->client->getUser($username);
//            if ($user) {
//                $user = $this->parseUser($user);
//            }
//        }
//
//        return $user;
//    }
//
//    /**
//     * @param $accessToken
//     * @return array
//     * @throws \Exception
//     */
//    public function getUserByToken($accessToken)
//    {
//        $user = $this->providerService->getProviderByToken($accessToken, ['id', 'email', 'name', 'cpf']);
//        if(!$user) throw new UserNotFoundException();
//        return $user;
//    }
//
//    /**
//     * @param $username
//     * @param array $data
//     * @return array
//     * @throws \Exception
//     */
//    public function updateUserByUsername($username, array $data)
//    {
//        unset($data['username']);
//        $this->client->updateUserAttributes($username, $data);
//
//        $userUpdated = $this->client->getUser($username);
//
//        return [
//            "error" => false,
//            "message" => "Usuário atualizado com sucesso!",
//            "data" => $userUpdated
//        ];
//    }
//
//    /**
//     * @param array $data
//     * @return array|\Illuminate\Http\JsonResponse
//     * @throws \Exception
//     */
//    public function registerUser(array $data)
//    {
//        $username = $data['username'];
//        $password = $data['password'];
//        unset($data['username']);
//        unset($data['password']);
//
//        $data['email'] = $username;
//        $this->client->registerUser($username, $password, $data);
//        $userCreated = $this->client->getUser($username);
//
//        return [
//            "error"   => false,
//            "message" => "Usuário cadastrado com sucesso!",
//            "data"    => $userCreated
//        ];
//    }
//
//    /**
//     * @param array $data
//     * @return array|\Illuminate\Http\JsonResponse
//     * @throws \Exception
//     */
//    public function resetPassword(array $data)
//    {
//        try {
//            $this->client->resetPassword($data['code'], $data['username'], $data['password']);
//
//            return [
//                "error" => false,
//                "message" => "Senha atualizada com sucesso!",
//            ];
//
//        } catch (\Exception $e) {
//            throw $e;
//        }
//
//    }
//
//    /**
//     * @param array $data
//     * @return array|\Illuminate\Http\JsonResponse
//     * @throws \Exception
//     */
//    public function sendConfirmSignUp(array $data)
//    {
//        try {
//            $this->client->confirmUserRegistration($data['code'], $data['username']);
//            return [
//                "error" => false,
//                "message" => "Cadastro confirmado com sucesso!",
//            ];
//
//        } catch (\Exception $e) {
//            throw $e;
//        }
//
//    }
//
//    /**
//     * @param $username
//     * @return array
//     * @throws \Exception
//     */
//    public function sendForgotPassword($username)
//    {
//        $this->client->sendForgottenPasswordRequest($username);
//
//        return [
//            "error" => false,
//            "message" => "Link de recuperação enviado com sucesso!",
//        ];
//
//    }
//
//
//    /**
//     * @param array $data
//     * @return array
//     * @throws \Exception
//     */
//    public function sendConfirmPasswordReset(array $data)
//    {
//        $this->client->resetPassword($data['code'], $data['username'], $data['password']);
//
//        return [
//            "error" => false,
//            "message" => "Senha atualizada com sucesso!",
//        ];
//
//    }
//
//    /**
//     * @param $user
//     * @return array
//     * @throws \Exception
//     */
//    public function parseUser($user)
//    {
//        $userParsed = [];
//
//        foreach ($user['data'] as $field) {
//            if(!in_array($field['Name'], ['email_verified', 'sub', 'phone_number_verified'])) {
//                $userParsed[$field['Name']] = $field['Value'];
//            }
//        }
//
//        return $userParsed;
//
//    }

}
