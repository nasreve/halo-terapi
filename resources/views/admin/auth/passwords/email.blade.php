@extends('admin.auth.layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Forgot Password</h3>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Masukkan alamat email pada form di bawah.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success mt-0 mb-4" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger mt-0 mb-4" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
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
                                        autofocus
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center mt-4 pt-2">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary mr-auto ml-auto">Submit</button>
                                    <p class="pt-2 mt-4 mb-2">
                                        Anda sudah ingat?
                                        <a href="{{ route('login.form') }}" class="tbr_text-success">Login</a>
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

{{-- @extends('admin.auth.layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <div class="tbr_auth_container">
        <div class="card tbr_auth_card">
            <div class="text-center">
                <h2 class="mb-2 font-weight-bold tbr_text-primary">Forgot Password</h2>
            </div>

            @if (session('status'))
                <div class="alert alert-success text-center my-2" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger my-2" role="alert">
                    <strong>Gagal!</strong>
                    <br />
                    {{ session('error') }}
                </div>
            @endif

            <div class="text-center pt-2 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <p>Masukkan alamat email pada form dibawah.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group mb-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn tbr_btn-primary">
                        Submit
                    </button>
                </div>
                <p class="text-center mt-5">Anda sudah ingat? <a href="{{ route('login.form') }}">Login</a></p>
            </form>
        </div>
    </div>
@endsection --}}