@extends('visitor.patient.auth.layouts.app')
@section('title', 'Email Verification')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Verifikasi</h3>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">

                                        @if (session('success'))
                                            <div class="alert alert-primary mb-4 mt-3" role="alert">
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                        @endif

                                        <p class="mb-3 pb-2">
                                            Sebelum melengkapi data, <span class="tbr_text-danger">silakan cek kotak masuk
                                            pada email Anda</span>. Kami mengirimkan link untuk aktivasi akun. Jika belum
                                            menerima email, silakan klik link di bawah ini.
                                        </p>

                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ request()->route('id') }}">
                                            <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-light tbr_bg-white m-auto">
                                                <span class="tbr_text-success">
                                                    Klik di sini untuk minta link verifikasi
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection