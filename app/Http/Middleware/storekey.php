<?php

namespace App\Http\Middleware;

use Closure;

class storekey
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

       /* $token = $request->header('Store_Key');
        if($token !='WackAMolE') {
            return response()->json(['message' => 'You do not have Permission'], 401);
        } */
        return $next($request);
    }
}
