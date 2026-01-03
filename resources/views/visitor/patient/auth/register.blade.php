@extends('visitor.patient.auth.layouts.app')
@section('title', 'Register')
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
                                            Silakan membuat akun terlebih dahulu untuk
                                            melanjutkan proses pemesanan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('patient.register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Nama Lengkap"
                                        tabindex=""
                                        spellcheck="false"
                                        autocomplete="name"
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
                                    <div class="input-group tbr_fix_ig">
                                        <div class="input-group-prepend">62</div>
                                        <input
                                            type="number"
                                            class="form-control @error('whatsapp_number') is-invalid @enderror rounded-right"
                                            id="whatsapp_number"
                                            name="whatsapp_number"
                                            placeholder="WhatsApp"
                                            tabindex=""
                                            spellcheck="false"
                                            min="1"
                                            required
                                        >
                                        @error('whatsapp_number')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <p>Pilih sesuai dengan lokasi tempat tinggal :</p>
                                </div>
                                <div class="form-group position-relative">
                                    <select
                                        class="form-control @error('province_id') is-invalid @enderror"
                                        id="province_id"
                                        name="province_id"
                                        tabindex=""
                                        required
                                    >
                                        <option value="" disabled selected>Provinsi</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? "selected" : "" }} >{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group position-relative">
                                    <select
                                        class="form-control @error('regency_id') is-invalid @enderror"
                                        id="regency_id"
                                        name="regency_id"
                                        tabindex=""
                                        required
                                    >
                                        <option value="" disabled selected>Kabupaten</option>
                                        @if (old('province_id'))
                                            @foreach (getRegencyByProvinceId(old('province_id')) as $regency)
                                                <option value="{{ $regency->id }}" {{ old('regency_id') == $regency->id ? "selected" : "" }} >{{ $regency->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('regency_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group position-relative">
                                    <select
                                        class="form-control @error('district_id') is-invalid @enderror"
                                        id="district_id"
                                        name="district_id"
                                        tabindex=""
                                        required
                                    >
                                        <option value="" disabled selected>Kecamatan</option>
                                        @if (old('regency_id'))
                                            @foreach (getDistrictByRegencyId(old('regency_id')) as $district)
                                                <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? "selected" : "" }} >{{ $district->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="text-center">
                                    <p>Anda mengetahui haloterapi dari mana?</p>
                                </div>
                                <div class="form-group position-relative">
                                    <select
                                        class="form-control @error('source') is-invalid @enderror"
                                        id="source"
                                        name="source"
                                        tabindex=""
                                        required
                                    >
                                        <option value="" disabled selected>Sumber Informasi</option>
                                        <option {{ old('source') == "Rekomendasi" ? "selected" : "" }} value="Rekomendasi">Rekomendasi</option>
                                        <option {{ old('source') == "Voucher" ? "selected" : "" }} value="Voucher">Voucher</option>
                                        <option {{ old('source') == "Google Maps" ? "selected" : "" }} value="Google Maps">Google Maps</option>
                                        <option {{ old('source') == "Whatsapp" ? "selected" : "" }} value="Whatsapp">WhatsApp</option>
                                        <option {{ old('source') == "Facebook" ? "selected" : "" }} value="Facebook">Facebook</option>
                                        <option {{ old('source') == "Instagram" ? "selected" : "" }} value="Instagram">Instagram</option>
                                        <option {{ old('source') == "TikTok" ? "selected" : "" }} value="TikTok">TikTok</option>
                                        <option {{ old('source') == "YouTube" ? "selected" : "" }} value="YouTube">YouTube</option>
                                        <option {{ old('source') == "Radio" ? "selected" : "" }} value="Radio">Radio</option>
                                    </select>
                                    @error('source')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <hr>
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
                                        autocomplete="email"
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
                                        autocomplete="password"
                                        tabindex=""
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
                                        autocomplete="password_confirmation"
                                        tabindex=""
                                        required
                                    >
                                </div>
                                <div class="text-center mt-4 pt-2">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary mr-auto ml-auto">Submit</button>
                                    <p class="mt-4 mb-2">
                                        Anda sudah punya akun?
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
    <script src="{{ asset('assets/js/visitor/province.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/regency.js') }}"></script>
    <script>
        $('select').select2();
    </script>
@endsection