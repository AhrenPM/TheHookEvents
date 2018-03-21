<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Icon -->
        <link rel="icon" href="/img/SiteIcon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/responsiveDesign/640px/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/credits.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/header.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/responsiveDesign/1000px/header.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/Footer-Dark.css') }}">
        @yield('styles')

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/header.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/credits.js') }}"></script>
        @yield('scripts')

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @include('authHeader')

        @yield('content')

        @yield('footer')
    </body>
</html>
