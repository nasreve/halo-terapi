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
    <link rel="stylesheet" href="{{ asset('porto/assets/visitor/css/app.css') }}">
    @yield('blockhead')

    <!-- Head Libs -->
    <script src="{{ asset('porto/vendor/modernizr/modernizr.js') }}"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

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
