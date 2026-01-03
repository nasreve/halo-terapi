@extends('admin.layouts.app')
@section('title', 'Detail Pesanan')
@section('blockhead')
    <link rel="stylesheet" href="{{ asset('porto/vendor/summernote/summernote-bs4.css') }}" />
    <link rel="stylesheet" href="{{ asset('porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@endsection
@section('content')
    <header class="page-header">
        <h2>Detail Pesanan</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/svg/icon_home.svg') }}">
                    </a>
                </li>
                <li>
                    <a href="{{ route('order.index') }}">
                        Pesanan
                    </a>
                </li>
                <li>
                    <span>Detail</span>
                </li>
            </ol>
        </div>
    </header>
    <div class="row tbr_edit_data">
        <div class="col-lg-3">
            @include('admin.order.partials.info')
        </div>
        <div class="col-lg-6">
            @include('admin.order.partials.detail')
        </div>
        <div class="col-lg-3">
            @include('admin.order.partials.status')
        </div>
    </div>
@endsection
@section('blockfoot')
    <script src="{{ asset('porto/vendor/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/default-ajax.js') }}"></script>
    <script>
        $('.tbr_order').addClass('nav-active');
        $('.tbr_order').addClass('nav-expanded');
    </script>
@endsection