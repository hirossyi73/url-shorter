<?php

namespace Hirossyi73\UrlShorter\Middleware;

use Closure;

class AuthenticateApi
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

        // check key
        $key = $request->get('key');
        $password = config('url_shorter.auth.password');
        if(empty($key) || $key !== $password){
            return response()->json([
                'error' => trans('url_shorter::url_shorter.errors.wrong_key'),
            ], 403);
        }

        return $next($request);
    }
}
