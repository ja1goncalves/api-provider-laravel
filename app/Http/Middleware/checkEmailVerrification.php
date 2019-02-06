<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkEmailVerrification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            $credentials['email'] = $request->username;
            $credentials['password'] = $request->password;
            $credentials['active'] = 1;
            $credentials['deleted'] = null;

            if(!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized, user not activated'
                ], 401);
            }else
                return $next($request);
    }
}

