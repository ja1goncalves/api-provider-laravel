<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 05/02/19
 * Time: 14:53
 */

namespace App\Services;

use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Repositories\PasswordResetRepository;
use App\Repositories\ProviderRepository;

class PasswordResetService
{

    protected $repositoryProvider;

    protected $repositoryPasswordReset;

    /**
     * @param ProviderRepository $providerRepository
     * @param PasswordResetRepository $passwordResetRepository
     */
    public function __construct(ProviderRepository $providerRepository, PasswordResetRepository $passwordResetRepository)
    {
        $this->repositoryProvider = $providerRepository;
        $this->repositoryPasswordReset = $passwordResetRepository;
    }

    public function create($request)
    {
        try{

            $provider = $this->repositoryProvider->skipPresenter()->findByField('email',$request->email)->first();
            $passwordReset = $this->repositoryPasswordReset->updateOrCreate(
                [   'email' => $provider->email],
                [
                    'email' => $provider->email,
                    'token' => str_random(60)
                ]
            );
            if (isset($provider) && isset($passwordReset))
                $provider->notify( new PasswordResetRequest($passwordReset->token));
            return response()->json([
                'message' => 'We have e-mailed your password reset link!'
            ]);
        }catch (\Exception $e){
            return response()->json(['message' => "We can't find a user with that e-mail address."], 404);
        }

    }

    public function find($token)
    {
        $passwordReset = $this->repositoryPasswordReset->findByField('token', $token)->first();

        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(60)->isPast()) {

            $this->repositoryPasswordReset->delete($passwordReset->id);

            return response()->json([
                'message' => 'This password reset token expired.'
            ], 404);
        }

        return response()->json($passwordReset);
    }

    public function reset($request)
    {
        $where =[
            'token' => $request->token,
            'email' => $request->email
        ];
        $passwordReset = $this->repositoryPasswordReset->skipPresenter()->findWhere($where)->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);

        $provider = $this->repositoryProvider->findByField('email', $passwordReset->email)['data'][0];

        if (!isset($provider)) {

            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        }

        $provider['password'] = bcrypt($request->password);
        $this->repositoryProvider->update($provider,$provider['id']);

        $passwordReset->notify(new PasswordResetSuccess());
        $this->repositoryPasswordReset->delete($passwordReset->id);

        return response()->json([
            'message' => 'This password reset success .'
        ], 200);
    }
}
