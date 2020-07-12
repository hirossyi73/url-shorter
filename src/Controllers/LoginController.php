<?php

namespace Hirossyi73\UrlShorter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function index(Request $request)
    {
        return view('url_shorter::login.index', [
            'action' => \UrlShorter::shorter_login_url()
        ]);
    }

    /**
     * 
     *
     */
    public function login(Request $request)
    {
        \Validator::make($request->all(), [
            'password' => 'required',
        ])->validate();

        $input = $request->get('password');
        $password = config('url_shorter.auth.password');

        if($input !== $password){
            return back()->withErrors(['password' => trans('url_shorter::url_shorter.errors.wrong_password')]);
        }
        
        session(['url_shorter_auth_web' => true]);
        return redirect(\UrlShorter::shorter_make_url());
    }
}
