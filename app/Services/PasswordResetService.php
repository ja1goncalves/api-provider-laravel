<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 05/02/19
 * Time: 14:53
 */

namespace App\Services;

use App\Entities\Provider;
use App\Jobs\SendMailBySendGrid;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Repositories\PasswordResetRepository;
use App\Repositories\ProviderRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function create($data)
    {
        try{

            $provider = $this->repositoryProvider->skipPresenter()->findByField('email',$data['email'])->first();
            $passwordReset = $this->repositoryPasswordReset->updateOrCreate(
                [   'email' => $provider->email],
                [
                    'email' => $provider->email,
                    'token' => Str::random(60)
                ]
            );
            if (isset($provider) && isset($passwordReset)){
                $url_front = Config::get('services.provider_front.url');
                $data_send_mail = [
                    'provider' => $provider,
                    'url_reset' => url("{$url_front}/recuperar-senha/".$passwordReset->token)
                ];

                Mail::send('email.password_reset', ['data' => $data_send_mail], function ($message) use ($provider) {
                    $message->from('contato@elomilhas.com.br', 'Elomilhas')
                        ->to($provider->email, $provider->name)
                        ->subject('Confirmação de Conta');
                });
            }
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

        if (Carbon::parse($passwordReset->updated_at)->addHours(6)->isPast()) {

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

        $provider = $this->repositoryProvider->findByField('email', $passwordReset->email)->first();

        if (!$provider) {
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        }

//        $providerdata = [
//            'password' => bcrypt($request->password)
//        ];
//        $this->repositoryProvider->update($providerdata,$provider->id);

        $provider = Provider::where('email', $passwordReset->email)->first();
        $provider->password = bcrypt($request->password);
        $provider->save();

        Mail::send('email.password_change', ['provider' => $provider], function ($message) use ($provider) {
            $message->from('contato@elomilhas.com.br', 'Elomilhas')
                ->to($provider->email, $provider->name)
                ->subject('Confirmação de Conta');
        });

        $this->repositoryPasswordReset->delete($passwordReset->id);

        return response()->json([
            'message' => 'This password reset success .'
        ], 200);
    }
}
