<?php

namespace App\Http\Middleware;

use App\Entities\Provider;
use Closure;

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
        $checkMail = Provider::where('email',$request->all()['username'])->first()->checkMail();
        if ($checkMail)
            return $next($request);
        else{
            return response()->json([
                'message' => 'Unauthorized, not validated email'
            ], 401);
        }
    }
}
