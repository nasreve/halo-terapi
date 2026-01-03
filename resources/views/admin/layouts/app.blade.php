<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fixed sidebar-left-sm">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'Haloterapi') }} - @yield('title')</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="google-site-verification" content="" />
        <meta name="msvalidate.01" content="" />
        <meta name="robots" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="shortcut icon" href="{{ asset('Favicon.png') }}" type="image/x-icon" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('porto/vendor/font-awesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/simple-line-icons/css/simple-line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/animate/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/slick/slick/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/slick/slick/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/pnotify/pnotify.custom.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/magnific-popup/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
        <link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
        @yield('blockhead')

        <link rel="stylesheet" href="{{ asset('porto/css/theme.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/admin/layout.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/admin/button.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/admin/form.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/admin/table.css') }}" />

        <script src="{{ asset('porto/vendor/modernizr/modernizr.js') }}"></script>
    </head>
    <body>

        <div class="tbr_page_loader">
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <section class="body">
            @include('admin.layouts.header')
            <div class="inner-wrapper">
                @include('admin.layouts.sidebar-left')
                <section role="main" class="content-body">
                    @if (session('errors'))
                        <div class="tbr_alert tbr_danger mb-4">
                            <p class="mb-0">{{ session('errors') }}</p>
                        </div>
                    @endif
                    @yield('content')
                </section>
            </div>
        </section>
        @yield('sticky-toolbar')

        <script src="{{ asset('porto/vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('porto/vendor/popper/umd/popper.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/slick/slick/slick.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('porto/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
        <script src="{{ asset('porto/vendor/common/common.js') }}"></script>
        <script src="{{ asset('porto/vendor/nprogress/nprogress.js') }}"></script>
        <script src="{{ asset('porto/vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ asset('porto/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('porto/vendor/pnotify/pnotify.custom.js') }}"></script>
        <script src="{{ asset('porto/vendor/select2/js/select2.js') }}"></script>
        @yield('blockfoot')

        <script src="{{ asset('porto/js/theme.js') }}"></script>
        <script src="{{ asset('porto/js/theme.init.js') }}"></script>
        <script src="{{ asset('assets/js/admin/button.js') }}"></script>
        <script>
            $(function () {
                $("html, body").animate({ scrollTop: 0 }, "fast");

                $(".tbr_page_loader").fadeOut( "slow" );
            })
        </script>
    </body>
</html>