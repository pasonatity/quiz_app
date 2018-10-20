<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @stack('css')
    </head>
    <body>
        <div id="app">
           @include('layouts.header')
            <div class="container my-4">
                @yield('contents')
            </div>
        </div>
        <!-- Script -->
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('script')
    </body>
</html>
