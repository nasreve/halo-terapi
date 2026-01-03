<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Halo Terapi') }} - @yield('title')</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="google-site-verification" content="" />
    <meta name="msvalidate.01" content="" />
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- All CSS -->
    <link rel="stylesheet" href="{{ asset('porto/vendor/font-awesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('porto/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('porto/vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('porto/vendor/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('porto/vendor/slick/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('porto/vendor/pnotify/pnotify.custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />

    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap">

    <link rel="stylesheet" href="{{ asset('assets/css/admin/auth/app.css') }}">

    @yield('blockhead')

    <!-- Head Libs -->
    <script src="{{ asset('porto/vendor/modernizr/modernizr.js') }}"></script>
</head>

<body>
    @yield('content')

    <!-- All JS -->
    <script src="{{ asset('porto/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('porto/vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('porto/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('porto/vendor/slick/slick/slick.min.js') }}"></script>
    <script src="{{ asset('porto/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('porto/vendor/common/common.js') }}"></script>
    <script src="{{ asset('porto/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('porto/vendor/pnotify/pnotify.custom.js') }}"></script>
    <script src="{{ asset('porto/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('porto/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
    <script src="{{ asset('porto/js/login-ajax.js') }}"></script>
    <script src="{{ asset('porto/assets/visitor/js/app.js') }}"></script>
    @yield('blockfoot')
</body>

</html>
