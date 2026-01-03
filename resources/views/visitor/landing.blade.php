@extends('visitor.layouts.app')
@section('title', 'Tinggal klik, tanpa ke klinik')
@section('cart')
    @include('visitor.includes.cart')
@endsection
@section('content')
    @include('visitor.includes.hero')
    @include('visitor.includes.slider')
    @include('visitor.includes.service')
    @include('visitor.includes.review')
    @include('visitor.includes.call-to-action')
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/order.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/login.js') }}"></script>
    <script>
        /* ======================================
        * Fix positioning floting whatsapp
        ====================================== */
        if ( $(".tbr_cart").hasClass("d-none") ) {
            $(".tbr_floating_cta").removeClass("tbr_active_cart")
        } else {
            $(".tbr_floating_cta").addClass("tbr_active_cart")
        }

        /* ======================================
        * Add active class to current page
        ====================================== */
        $('.tbr_nav_home').addClass('tbr_nav_active');
    </script>
@endsection