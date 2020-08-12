<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="{{ asset('css/stylepublic2.css') }}" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!--<script src="{{ asset('js/custom.js') }}"></script>-->
    <link href="{{ asset('css/custompublic2.css') }}" rel="stylesheet">
</head>

<body style="height: 100% !important;">
    <div id="app" style="height: 100% !important;">


        <main class="py-4" style="height: 100% !important;">
            @yield('content')
        </main>
    </div>
    <!-- Classie 
    <script src="{{ asset('js/classie.js') }}"></script>
    scrolling js
    <script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    scrolling js
     Bootstrap Core JavaScript 
    <script src="{{ asset('js/bootstrap.js') }}"> </script>-->
    @yield('script')
</body>

</html>