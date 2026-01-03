@extends('admin.auth.layouts.app')
@section('title', 'Login')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Login</h3>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Silakan masuk menggunakan email dan password yang sudah Anda miliki.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger mt-0 mb-4" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Email"
                                        tabindex=""
                                        spellcheck="false"
                                        required
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        value="{{ old('password') }}"
                                        placeholder="Password"
                                        tabindex=""
                                        spellcheck="false"
                                        required
                                    >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row no-gutters mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                <label class="custom-control-label" for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <a href="{{ route('password.request') }}" class="tbr_text-success">Forgot Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_btn_login mr-auto ml-auto">Login</button>
                                    <p class="pt-2 mt-4 mb-0">
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

{{-- @extends('admin.auth.layouts.app')
@section('title', 'Login')
@section('content')
    <div class="tbr_auth_container">
        <div class="card tbr_auth_card">
            <div class="text-center">
                <h2 class="mb-2 font-weight-bold tbr_text-primary">Login</h2>
            </div>

            @if (session('error'))
                <div class="alert alert-danger my-2" role="alert">
                    <strong>Gagal!</strong>
                    <br />
                    {{ session('error') }}
                </div>
            @endif

            <div class="text-center pt-2 mb-4">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <p>Silakan masuk menggunakan email dan password yang sudah Anda miliki.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mb-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember_me" class="custom-control-input" id="remember_me">
                            <label for="remember_me" class="custom-control-label">Remember me</label>
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}">Forgot Password</a>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn tbr_btn-primary">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection --}}