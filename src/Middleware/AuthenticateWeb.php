<?php

namespace Hirossyi73\UrlShorter\Middleware;

use Closure;

class AuthenticateWeb
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!boolval(config('url_shorter.auth.use', false))){
            return $next($request);
        }

        if(session()->has('url_shorter_auth_web')){
            return $next($request);
        }
        
        return redirect(\UrlShorter::shorter_login_url());
    }
}
