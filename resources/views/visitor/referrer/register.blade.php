@extends('visitor.patient.auth.layouts.app')
@section('title', 'Pendaftaran Referrer')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card tbr_card-lg">
                        <div class="card-body">
                            <div class="text-center">
                                <h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Register</h3>
                                <div class="row justify-content-center">
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                        <p class="mb-4 pb-2">
                                            Silakan mendaftar sebagai referrer pada
                                            form yang sudah kami sediakan.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('referrer.register') }}" method="POST" class="main_form">
                                @csrf
                                {{-- Personal Data --}}
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Nama Lengkap</label>
                                            <input
                                                type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name"
                                                name="name"
                                                value="{{ old('name') }}"
                                                placeholder=""
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
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group position-relative">
                                            <label for="province_id" class="mb-1">Provinsi</label>
                                            <select
                                                class="form-control @error('province_id') is-invalid @enderror"
                                                id="province_id"
                                                name="province_id"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                                <option value="" disabled selected>Select</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? "selected" : "" }}>{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('province_id')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group position-relative">
                                            <label for="regency_id" class="mb-1">Kabupaten</label>
                                            <select
                                                class="form-control @error('regency_id') is-invalid @enderror"
                                                id="regency_id"
                                                name="regency_id"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                                <option value="" disabled selected>Select</option>
                                                @if (old('province_id'))
                                                    @foreach (getRegencyByProvinceId(old('province_id')) as $regency)
                                                        <option value="{{ $regency->id }}" {{ old('regency_id') == $regency->id ? "selected" : "" }}>{{ $regency->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('regency_id')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group position-relative">
                                            <label for="district_id" class="mb-1">Kecamatan</label>
                                            <select
                                                class="form-control @error('district_id') is-invalid @enderror"
                                                id="district_id"
                                                name="district_id"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                                <option value="" disabled selected>Select</option>
                                                @if (old('regency_id'))
                                                    @foreach (getDistrictByRegencyId(old('regency_id')) as $district)
                                                        <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? "selected" : "" }}>{{ $district->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('district_id')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="village" class="mb-1">Kelurahan</label>
                                            <input
                                                type="text"
                                                class="form-control @error('village') is-invalid @enderror"
                                                id="village"
                                                name="village"
                                                value="{{ old('village') }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >
                                            @error('village')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address" class="mb-1">Detail Alamat</label>
                                            <textarea
                                                type="text"
                                                class="form-control tbr_disables_resizing @error('address') is-invalid @enderror"
                                                id="address"
                                                name="address"
                                                placeholder="Gang, Jalan, RT, RW, Dusun"
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address_origin" class="mb-1">Alamat Asal</label>
                                            <textarea
                                                type="text"
                                                class="form-control tbr_disables_resizing @error('address_origin') is-invalid @enderror"
                                                id="address_origin"
                                                name="address_origin"
                                                placeholder="Gang, Jalan, RT, RW, Dusun, Kelurahan, Kecamatan, Kabupaten, Provinsi"
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >{{ old('address_origin') }}</textarea>
                                            @error('address_origin')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="business_community" class="mb-1">Komunitas Bisnis</label>
                                            <input
                                                type="text"
                                                class="form-control @error('business_community') is-invalid @enderror"
                                                id="business_community"
                                                name="business_community"
                                                value="{{ old('business_community') }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >
                                            @error('business_community')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="business_name" class="mb-1">Nama Usaha</label>
                                            <input
                                                type="text"
                                                class="form-control @error('business_name') is-invalid @enderror"
                                                id="business_name"
                                                name="business_name"
                                                value="{{ old('business_name') }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >
                                            @error('business_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="business_address" class="mb-1">Alamat Usaha</label>
                                            <textarea
                                                type="text"
                                                class="form-control tbr_disables_resizing @error('business_address') is-invalid @enderror"
                                                id="business_address"
                                                name="business_address"
                                                placeholder="Gang, Jalan, RT, RW, Dusun, Kelurahan, Kecamatan, Kabupaten, Provinsi"
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >{{ old('business_address') }}</textarea>
                                            @error('business_address')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone_number" class="mb-1">Nomor Telepon</label>
                                            <div class="input-group tbr_fix_ig">
                                                <div class="input-group-prepend">62</div>
                                                <input
                                                    type="number"
                                                    class="form-control rounded-right @error('phone_number') is-invalid @enderror"
                                                    id="phone_number"
                                                    name="phone_number"
                                                    value="{{ old('phone_number') }}"
                                                    placeholder=""
                                                    tabindex=""
                                                    spellcheck="false"
                                                    required
                                                    min="0"
                                                >
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="whatsapp_number" class="mb-1">Nomor WhatsApp</label>
                                            <div class="input-group tbr_fix_ig">
                                                <div class="input-group-prepend">62</div>
                                                <input
                                                    type="number"
                                                    class="form-control rounded-right @error('whatsapp_number') is-invalid @enderror"
                                                    id="whatsapp_number"
                                                    name="whatsapp_number"
                                                    value="{{ old('whatsapp_number') }}"
                                                    placeholder=""
                                                    tabindex=""
                                                    spellcheck="false"
                                                    required
                                                    min="0"
                                                >
                                                @error('whatsapp_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Bank Account --}}
                                <div class="tbr_page_title mt-4 mb-4 pt-0">
                                    <div class="tbr_small_title mb-1">Nomor Rekening</div>
                                    <p class="mb-0">Untuk memudahkan proses transaksi, kami perlu info nomor rekening Anda.</p>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bank_name" class="mb-1">Nama Bank</label>
                                            <input
                                                type="text"
                                                class="form-control @error('bank_name') is-invalid @enderror"
                                                id="bank_name"
                                                name="bank_name"
                                                value="{{ old('bank_name') }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                                required
                                            >
                                            @error('bank_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bank_account" class="mb-1">Atas Nama</label>
                                            <input
                                                type="text"
                                                class="form-control @error('bank_account') is-invalid @enderror"
                                                id="bank_account"
                                                name="bank_account"
                                                value="{{ old('bank_account') }}"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                            @error('bank_account')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="account_number" class="mb-1">Nomor Rekening</label>
                                            <input
                                                type="text"
                                                class="form-control @error('account_number') is-invalid @enderror"
                                                id="account_number"
                                                name="account_number"
                                                value="{{ old('account_number') }}"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                            @error('account_number')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tbr_form_box mt-4">
                                    <div class="form-group position-relative row">
                                        <label for="source" class="col-md-6 col-form-label mb-1 mb-md-0">Anda mengetahui haloterapi dari mana?</label>
                                        <div class="col-md-6">
                                            <select
                                                class="form-control @error('source') is-invalid @enderror"
                                                id="source"
                                                name="source"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                                <option value="" disabled selected title="Sumber Informasi">Sumber Informasi</option>
                                                <option {{ old('source') == "Rekomendasi" ? "selected" : "" }} value="Rekomendasi">Rekomendasi</option>
                                                <option {{ old('source') == "Voucher" ? "selected" : "" }} value="Voucher">Voucher</option>
                                                <option {{ old('source') == "Google Maps" ? "selected" : "" }} value="Google Maps">Google Maps</option>
                                                <option {{ old('source') == "WhatsApp" ? "selected" : "" }} value="WhatsApp">WhatsApp</option>
                                                <option {{ old('source') == "Facebook" ? "selected" : "" }} value="Facebook">Facebook</option>
                                                <option {{ old('source') == "Instagram" ? "selected" : "" }} value="Instagram">Instagram</option>
                                                <option {{ old('source') == "TikTok" ? "selected" : "" }} value="TikTok">TikTok</option>
                                                <option {{ old('source') == "Youtube" ? "selected" : "" }} value="YouTube">YouTube</option>
                                                <option {{ old('source') == "Radio" ? "selected" : "" }} value="Radio">Radio</option>
                                            </select>
                                            @error('source')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- App Account --}}
                                <div class="tbr_page_title mt-4 mb-4 pt-2">
                                    <div class="tbr_small_title mb-1">Data akun</div>
                                    <p class="mb-0">Anda hanya diperbolehkan untuk mengubah password saja.</p>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email" class="mb-1">Email</label>
                                            <input
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                placeholder=""
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password" class="mb-1">Password</label>
                                            <input
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password"
                                                name="password"
                                                value="{{ old('password') }}"
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="mb-1">Konfirmasi Password</label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                value=""
                                                placeholder=""
                                                tabindex=""
                                                required
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4 pt-0">
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
    <script src="{{ asset('assets/js/visitor/setting/province.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/regency.js') }}"></script>
    <script>
        $('select').select2();
    </script>
@endsection