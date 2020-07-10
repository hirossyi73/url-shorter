<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <link rel="stylesheet" href="{{asset('url-shorter/css/bootstrap.min.css')}}">
        
        <script src="{{asset('url-shorter/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('url-shorter/js/popper.min.js ')}}"></script>
        <script src="{{asset('url-shorter/js/bootstrap.min.js')}}"></script>
    </head>
    <body>
        <div id="app" class="mt-5">
            @yield('content')
        </div>
    </body>
</html>
