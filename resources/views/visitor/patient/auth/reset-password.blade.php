@extends('visitor.patient.auth.layouts.app')
@section('title', 'Reset Password')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Reset Password</h3>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Silakan buat password baru pada form di bawah.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger mt-0 mb-4" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('patient.password.update') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                    <input type="hidden" name="email" value="{{ request()->query('email') }}">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="{{ request()->query('email') }}"
                                        placeholder="Email"
                                        tabindex=""
                                        spellcheck="false"
                                        required
                                        disabled
                                    >
                                </div>
                                <div class="form-group mb-3">
                                    <input
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        value=""
                                        placeholder="Password"
                                        tabindex=""
                                        required
                                        autofocus
                                    >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        value=""
                                        placeholder="Konfirmasi Password"
                                        tabindex=""
                                        required
                                    >
                                </div>
                                <div class="text-center mt-4 pt-2">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary mr-auto ml-auto">Submit</button>
                                    <p class="pt-2 mt-4 mb-2">
                                        Anda sudah ingat?
                                        <a href="" class="tbr_text-success" data-toggle="modal" data-target="#modalLogin">Login</a>
                                    </p>
                                    <p class="mt-0 mb-0">
                                        <a href="{{ url('/') }}" class="tbr_text-success">
                                            <i class="icons icon-home"></i>&nbsp;
                                            Home
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/login.js') }}"></script>
@endsection