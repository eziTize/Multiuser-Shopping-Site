<?php

namespace App\Http\Middleware;

use Closure;

class CheckReferral
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
        $response = $next($request);

        // Check that there is not already a cookie set and that we have '?ref' in the url
        //if (! $request->hasCookie('ac_referral') && $request->query('ref') ) 

        if ($request->query('ref')){
          // Add a cookie to the response that lasts 1 Day (in minutes)
          $response->cookie( 'ac_referral', $request->query('ref'), 1440);
          //setcookie('ace_referral', $request->query('ref'), time() + (1800), "/");
        }

        return $response;
    }
}