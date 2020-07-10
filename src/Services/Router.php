<?php

namespace Hirossyi73\UrlShorter\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router as BaseRouter;

class Router
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Hirossyi73\UrlShorter\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function routes()
    {
        $this->routeWeb();
        $this->routeWebGenerate();
        $this->routeApi();
        $this->routeApiGenerate();
    }

    /**
     * Web web routes
     */
    public function routeWeb()
    {
        if(boolval(config('url_shorter.bind_root', true))){
            Route::group([
                'prefix'        => config('url_shorter.route.prefix'),
                'namespace'     => $this->namespace,
                'middleware'    => ['web'],
            ], function (BaseRouter $router) {
                $router->get('/', 'IndexController@notFound');
            });
        }

        Route::group([
            'prefix'        => \UrlShorter::url_join(config('url_shorter.route.prefix'), config('url_shorter.route.generate', 'g')),
            'namespace'     => $this->namespace,
            'middleware'    => ['web'],
        ], function (BaseRouter $router) {
            $router->get('/', 'IndexController@notFound');
            $router->get('/{key}', 'IndexController@redirect');
        });
    }

    /**
     * Web web routes for generate
     */
    public function routeWebMake()
    {
        Route::group([
            'prefix'        => \UrlShorter::url_join(config('url_shorter.route.prefix'), config('url_shorter.route.login', 'login')),
            'namespace'     => $this->namespace,
            'middleware'    => ['web'],
        ], function (BaseRouter $router) {
            $router->get('/', 'LoginController@index');
            $router->post('/', 'LoginController@login');
        });

        Route::group([
            'prefix'        => \UrlShorter::url_join(config('url_shorter.route.prefix'), config('url_shorter.route.make', 'make')),
            'namespace'     => $this->namespace,
            'middleware'    => ['web', 'url_shorter_auth_web'],
        ], function (BaseRouter $router) {
            $router->get('/', 'MakeController@index');
            $router->post('/', 'MakeController@make');
        });
    }

    public function routeApi()
    {
        Route::group([
            'prefix'        => \UrlShorter::url_join(config('url_shorter.route.prefix'), config('url_shorter.route.api', 'api'), config('url_shorter.route.generate', 'g')),
            'namespace'     => $this->namespace,
            'middleware'    => ['api'],
        ], function (BaseRouter $router) {
            $router->get('/{key}', 'ApiController@getWithKey');
            $router->post('/', 'ApiController@get');
        });
    }

    public function routeApiMake()
    {
        Route::group([
            'prefix'        => \UrlShorter::url_join(config('url_shorter.route.prefix'), config('url_shorter.route.api', 'api'), config('url_shorter.route.make', 'make')),
            'namespace'     => $this->namespace,
            'middleware'    => ['api', 'url_shorter_auth_api'],
        ], function (BaseRouter $router) {
            $router->post('/', 'ApiController@make');
        });
    }
}
