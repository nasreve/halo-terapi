<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        <title>{{ config('app.name', 'Haloterapi') }} - @yield('title')</title>
		<meta charset="UTF-8">
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="google-site-verification" content="" />
        <meta name="msvalidate.01" content="" />
        <meta name="robots" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('Favicon.png') }}" type="image/x-icon" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

        <link rel="stylesheet" href="{{ asset('porto/vendor/font-awesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/simple-line-icons/css/simple-line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/animate/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/slick/slick/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/slick/slick/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/pnotify/pnotify.custom.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
        @yield('blockhead')
        <link rel="stylesheet" href="{{ asset('assets/css/visitor/app.css') }}">

		<script src="{{ asset('porto/vendor/modernizr/modernizr.js') }}"></script>
    </head>
    <body class="tbr_authentication">
        <div class="tbr_page_loader">
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <main>
            @yield('content')
        </main>
        @include('visitor.partials.modal-login')

        <script src="{{ asset('porto/vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('porto/vendor/popper/umd/popper.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/slick/slick/slick.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ asset('porto/vendor/common/common.js') }}"></script>
        <script src="{{ asset('porto/vendor/pnotify/pnotify.custom.js') }}"></script>
        <script src="{{ asset('porto/vendor/select2/js/select2.js') }}"></script>
        <script src="{{ asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/visitor/app.js') }}"></script>
        @yield('blockfoot')
    </body>
</html>