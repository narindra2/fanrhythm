<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

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
        if($request->hasCookie('referral') || $request->hasCookie('referral_code_type_user')) {
           
            return $next($request);
        }else {
            if($request->query('ref') ) {
                Cookie::queue(Cookie::forget('referral_code_type_user'));
                return redirect($request->fullUrl())->withCookie(cookie('referral', $request->query('ref'),60*24*7));
            }
            if($request->query('ref_user')) {
                Cookie::queue(Cookie::forget('referral'));
                return redirect($request->fullUrl())->withCookie(cookie('referral_code_type_user', $request->query('ref_user'),60*24*7));
            }
        }
        return $next($request);
    }
}
