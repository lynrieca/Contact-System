<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- logic here: app.name can be found inside .env > APP_NAME --}}
        <title>{{config('app.name', 'Contact System')}}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
        <link rel="stylesheet" href="{{asset('css/index.css')}}">
        
        
    </head>
    <body>
        @include('layouts.nav-bar')
        <div class="container">
            {{-- @include('inc.messages') --}}
            @yield('content')
        </div> 

        
        <!-- CkEditor -->
        {{-- <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script> --}}
        
    </body>
</html>
