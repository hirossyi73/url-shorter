<?php

return [
    'bind_root' => env('URL_SHORTER_BIND_ROOT', true),

    'use_preview' => env('URL_SHORTER_USE_PREVIEW', false),

    'auth' => [
        'use' => env('URL_SHORTER_AUTH_USE', false),

        'password' => env('URL_SHORTER_AUTH_PASSWORD', 'password'),
    ],

    'generate' => [
        'words' => env('URL_SHORTER_GENERATE_WORDS', 'abcdefghijkmnpqrstuvwxyz23456789'),
    
        'length' => env('URL_SHORTER_GENERATE_LENGTH', 12),
        
        'check_already_exists' => env('URL_SHORTER_GENERATE_CHECK_ALREADY_EXISTS', true),
    ],

    'route' => [    
        'prefix' => env('URL_SHORTER_PREFIX', ''),
    
        'generate' => env('URL_SHORTER_ROUTE_GENERATE', 'g'),
    
        'make' => env('URL_SHORTER_ROUTE_MAKE', 'make'),
    
        'api' => env('URL_SHORTER_ROUTE_API', 'api'),
    
        'login' => env('URL_SHORTER_ROUTE_LOGIN', 'login'),
    ],

    'enabled' => [
        'web' => env('URL_SHORTER_ENABLED_WEB', true),
        
        'api' => env('URL_SHORTER_ENABLED_API', false),

        'web_make' => env('URL_SHORTER_ENABLED_WEB_MAKE', false),
        
        'api_make' => env('URL_SHORTER_ENABLED_API_MAKE', false),
    ],
];
