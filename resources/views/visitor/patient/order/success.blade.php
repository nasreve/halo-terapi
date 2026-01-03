@extends('visitor.layouts.app')
@section('title', 'Order Success')
@section('content')
    <div class="container">
        <div class="row justify-content-center no-gutters">
            <div class="col-xl-10 col-lg-10 col-md-10 col-12">
                <div class="tbr_success_box">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                            <div class="text-center">
                                <img class="mb-4" src="{{ asset('/assets/svg/illustration/order_success.svg') }}" alt="Order Success">
                                <h4 class="tbr_weight-extra-bold mb-3">Pesanan telah kami terima!</h4>
                                <p class="mb-4">
                                    Kami sangat berterima kasih karena sudah mempercayai kami. Bersama dengan
                                    hal ini, kami juga mengirimkan detail pesanan ke kotak masuk email Anda.
                                </p>
                                <div class="row justify-content-center mb-4 pb-2">
                                    <div class="col-xl-8 col-lg-11 col-md-11 col-12">
                                        <div class="alert alert-warning mb-0" role="alert">
                                            Admin haloterapi akan segera menghubungi Anda.
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('patient.order.history') }}" anim="ripple" class="btn tbr_btn tbr_btn-danger d-inline-flex mb-5 mb-lg-0">Masuk ke member area</a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                            <div class="text-center">
                                <img src="{{ asset('/assets/images/Person.png') }}" alt="Order Success">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection