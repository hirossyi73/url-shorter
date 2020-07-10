<?php

namespace Hirossyi73\UrlShorter;

use Hirossyi73\UrlShorter\Services\Router;
use Hirossyi73\UrlShorter\Model\Shorter;

class UrlShorter
{
    public function routes(){
        $route = new Router;
        $route->routes();
    }
    public function routeWeb(){
        $route = new Router;
        $route->routeWeb();
    }
    public function routeApi(){
        $route = new Router;
        $route->routeApi();        
    }

    public function routeWebMake(){
        $route = new Router;
        $route->routeWebMake();
    }
    public function routeApiMake(){
        $route = new Router;
        $route->routeApiMake();        
    }

    
    public function shorter_make_url($path = null, $secure = null){
        return $this->shorter_url($this->url_join(config('url_shorter.route.make', 'make'), $path));
    }
    
    public function shorter_generate_url($path = null, $secure = null){
        return $this->shorter_url($this->url_join(config('url_shorter.route.generate', 'g'), $path));
    }
    
    public function shorter_login_url($path = null, $secure = null){
        return $this->shorter_url($this->url_join(config('url_shorter.route.login', 'login'), $path));
    }

    

    public function url_join(...$pass_array)
    {
       return $this->join_paths("/", $pass_array);
    }   

    /**
     * Join path using trim_str.
     */
    public function join_paths($trim_str, $pass_array)
    {
        $ret_pass   =   "";

        foreach ($pass_array as $value) {
            if (empty($value)) {
                continue;
            }
            
            if (is_array($value)) {
                $ret_pass = $ret_pass.$trim_str.join_paths($trim_str, $value);
            } elseif ($ret_pass == "") {
                $ret_pass   =   $value;
            } else {
                $ret_pass   =   rtrim($ret_pass, $trim_str);
                $value      =   ltrim($value, $trim_str);
                $ret_pass   =   $ret_pass.$trim_str.$value;
            }
        }
        return $ret_pass;
    }
    

    public function generateKey(){
        // get rule
        $randomString = config('url_shorter.generate.words', 'abcdefghijkmnpqrstuvwxyz23456789');
        $length = config('url_shorter.generate.length', 12);
        $check = boolval(config('url_shorter.generate.check_already_exists', true));
        
        // ganerate
        for($i = 0; $i < 20; $i++){
            // get item with length
            $key = '';
            for ($l = 0; $l < $length; $l++) {
                $key .= substr($randomString, rand(0, (strlen($randomString) - 1)), 1);
            }

            if(!$check){
                return $key;
            }

            if(Shorter::where('key', $key)->count() == 0){
                return $key;
            }
        }
    }
    
    
    public function shorter_url($path = null, $secure = null){
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }
        
        if(!isset($secure)){
            if(\Request::secure() === true){
                $secure = true;
            }
            else{
                $secure = config('url_shorter.https', false);
            }
        }

        return url($this->shorter_base_path($path), [], $secure);
    }
    
    protected function shorter_base_path($path = '')
    {
        $prefix = '/'.trim(config('url_shorter.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix.'/'.$path;
    }
    
}
