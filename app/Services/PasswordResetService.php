<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 05/02/19
 * Time: 14:53
 */

namespace App\Services;

use App\Entities\Provider;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;

class PasswordResetService
{

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $provider = Provider::where('email', $request->email)->first();
        if (!$provider)
            return response()->json(['message' => "We can't find a user with that e-mail address."], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $provider->email],
            [
                'email' => $provider->email,
                'token' => str_random(60)
            ]
        );
        if ($provider && $passwordReset)
            $provider->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $provider = Provider::where('email', $passwordReset->email)->first();
        if (!$provider)
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        $provider->password = bcrypt($request->password);
        $provider->save();
        $passwordReset->delete();
        $provider->notify(new PasswordResetSuccess($passwordReset));
        return response()->json($provider);
    }
}
