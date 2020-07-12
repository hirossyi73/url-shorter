<?php

namespace Hirossyi73\UrlShorter;

use Illuminate\Support\ServiceProvider;

class UrlShorterServiceProvider extends ServiceProvider
{
    
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'url_shorter_auth.authweb'       => \Hirossyi73\UrlShorter\Middleware\AuthenticateWeb::class,
        'url_shorter_auth.authapi'       => \Hirossyi73\UrlShorter\Middleware\AuthenticateApi::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'url_shorter_auth_web' => [
            'url_shorter_auth.authweb',
        ],
        'url_shorter_auth_api' => [
            'url_shorter_auth.authapi',
        ],
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/url_shorter.php',
            'url_shorter'
        );

                
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        ////// register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'url_shorter');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'url_shorter');

        $this->publishes([__DIR__.'/../config' => config_path()]);
        $this->publishes([__DIR__.'/../public' => public_path('url-shorter')], 'public');

        
        $items = [
            [
                'key' => 'web',
                'suffix' => 'Web',
                'default' => true,
            ],
            [
                'key' => 'web_make',
                'suffix' => 'WebMake',
                'default' => false,
            ],
            [
                'key' => 'api',
                'suffix' => 'Api',
                'default' => false,
            ],
            [
                'key' => 'api_make',
                'suffix' => 'ApiMake',
                'default' => false,
            ],
        ];

        foreach($items as $item){
            if(boolval(config("url_shorter.enabled.{$item['key']}", $item['default']))){
                $func = "route{$item['suffix']}";
                \UrlShorter::{$func}();
            }
        }
    }
}
