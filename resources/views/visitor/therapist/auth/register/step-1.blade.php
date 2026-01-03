@extends('visitor.patient.auth.layouts.app')
@section('title', 'Register Step 1')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Register</h3>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Silakan membuat akun terlebih dahulu untuk melanjutkan proses pendaftaran.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('therapist.register.step-1.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Nama dan Gelar"
                                        tabindex=""
                                        spellcheck="false"
                                        autofocus
                                        required
                                    >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control @error('username') is-invalid @enderror"
                                        id="username"
                                        name="username"
                                        value="{{ old('username') }}"
                                        placeholder="Username"
                                        tabindex=""
                                        spellcheck="false"
                                        autofocus
                                        required
                                    >
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group tbr_fix_ig">
                                        <div class="input-group-prepend">62</div>
                                        <input
                                            type="number"
                                            min="0"
                                            class="form-control rounded-right @error('whatsapp') is-invalid @enderror"
                                            id="whatsapp"
                                            name="whatsapp"
                                            value="{{ old('whatsapp') }}"
                                            placeholder="Whatsapp"
                                            tabindex=""
                                            spellcheck="false"
                                            required
                                        >
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                    @error('whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Email"
                                        tabindex=""
                                        spellcheck="false"
                                        autofocus
                                        required
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        value="{{ old('password') }}"
                                        placeholder="Password"
                                        tabindex=""
                                        spellcheck="false"
                                        autofocus
                                        required
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
                                        value="{{ old('password_confirmation') }}"
                                        placeholder="Konfirmasi Password"
                                        tabindex=""
                                        spellcheck="false"
                                        autofocus
                                    >
                                </div>
                                <div class="text-center mt-4 pt-2">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary mr-auto ml-auto">Submit</button>
                                    <p class="mt-4 mb-2">
                                        Anda sudah punya akun?
                                        <a href="{{ route('therapist.login') }}" class="tbr_text-success">Login</a>
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