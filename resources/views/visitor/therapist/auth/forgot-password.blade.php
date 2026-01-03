@extends('visitor.therapist.auth.layouts.app')
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

                            <form action="{{ route('therapist.password.email') }}" method="POST">
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
                                        <span class="invalid-feedback d-block" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center mt-4 pt-2">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary mr-auto ml-auto">Submit</button>
                                    <p class="pt-2 mt-4 mb-2">
                                        Anda sudah ingat?
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