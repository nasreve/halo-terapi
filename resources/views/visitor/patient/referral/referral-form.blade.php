@extends('visitor.layouts.app')
@section('title', 'Kelengkapan Data')
@section('openMemberAside')
    <div class="container-fluid tbr_open_member_aside" anim="ripple">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            Navigasi Menu
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>
@endsection
@section('content')
    <div class="container">
        <div class="tbr_member_area">
            @include('visitor.layouts.patient-aside')
            <div class="tbr_member_content_body">
                <form action="{{ route('patient.referral.activate') }}" method="POST" class="main_form" data-redirect="{{ route('patient.referral.dashboard') }}">
                    @csrf
                    <div class="tbr_page_title mb-4">
                        <h4 class="tbr_weight-bold tbr_text-primary mb-1">Mohon untuk melengkapi data</h4>
                        <p class="mb-0">Formulir di bawah wajib untuk diisi semua.</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name" class="mb-1">Nama Lengkap</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{ $patient->name }}"
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group tbr_fix_ig">
                                <label for="date_of_birth" class="mb-1">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control datepicker"
                                        id="date_of_birth"
                                        name="date_of_birth"
                                        value="{{ formatDate($patient->date_of_birth, 'd-m-Y') }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                        autocomplete="off"
                                    >
                                    <div class="input-group-append">
                                        <img src="{{ asset('/assets/svg/icons/icon_calendar.svg') }}" alt="Calendar">
                                    </div>
                                    <div class="invalid-feedback" role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="age" class="mb-2">Jenis Kelamin</label>
                                <div class="tbr_radio_group">
                                    <div class="custom-control custom-radio custom-control-inline mb-0">
                                        <input type="radio" id="male" name="gender" value="Laki-laki" class="custom-control-input" {{ $patient->gender === "Laki-laki" ? "checked" : "" }}>
                                        <label class="custom-control-label" for="male">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-0">
                                        <input type="radio" id="female" name="gender" value="Perempuan" class="custom-control-input" {{ $patient->gender === "Perempuan" ? "checked" : "" }}>
                                        <label class="custom-control-label" for="female">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback" role="alert"></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="job" class="mb-1">Pekerjaan</label>
                                <select
                                    class="form-control"
                                    id="job"
                                    name="job"
                                    tabindex=""
                                >
                                    <option title="Select">Select</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job }}" {{ $patient->job === $job ? "selected" : "" }} >{{ $job }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="province_id" class="mb-1">Provinsi</label>
                                <select
                                    class="form-control"
                                    id="province_id"
                                    name="province_id"
                                    placeholder=""
                                    tabindex=""
                                >
                                    <option title="Select" value="" disabled selected>Select</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $patient->province_id === $province->id ? "selected" : "" }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="regency_id" class="mb-1">Kabupaten</label>
                                <select
                                    class="form-control"
                                    id="regency_id"
                                    name="regency_id"
                                    placeholder=""
                                    tabindex=""
                                >
                                    <option title="Select" value="" disabled selected>Select</option>
                                    @foreach ($regencies as $regency)
                                        <option value="{{ $regency->id }}" {{ $patient->regency_id === $regency->id ? "selected" : "" }}>{{ $regency->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="district_id" class="mb-1">Kecamatan</label>
                                <select
                                    class="form-control"
                                    id="district_id"
                                    name="district_id"
                                    placeholder=""
                                    tabindex=""
                                >
                                    <option title="Select" value="" disabled selected>Select</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $patient->district_id === $district->id ? "selected" : "" }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="village" class="mb-1">Kelurahan</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="village"
                                    name="village"
                                    value="{{ $patient->village }}"
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="address" class="mb-1">Detail Alamat</label>
                                <textarea
                                    type="text"
                                    class="form-control tbr_disables_resizing"
                                    id="address"
                                    name="address"
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >{{ $patient->address }}</textarea>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="address_origin" class="mb-1">Alamat Asal</label>
                                <textarea
                                    type="text"
                                    class="form-control tbr_disables_resizing"
                                    id="address_origin"
                                    name="address_origin"
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >{{ $patient->address_origin }}</textarea>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="business_community" class="mb-1">Komunitas Bisnis</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="business_community"
                                    name="business_community"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="business_name" class="mb-1">Nama Usaha</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="business_name"
                                    name="business_name"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="business_address" class="mb-1">Alamat Usaha</label>
                                <textarea
                                    type="text"
                                    class="form-control tbr_disables_resizing"
                                    id="business_address"
                                    name="business_address"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                ></textarea>
                                <div class="invalid-feedback" role="alert"></div>
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
                                        class="form-control rounded-right"
                                        id="phone_number"
                                        name="phone_number"
                                        value="{{ $patient->phone_number }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                        min="0"
                                    >
                                    <div class="invalid-feedback" role="alert"></div>
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
                                        class="form-control rounded-right"
                                        id="whatsapp_number"
                                        name="whatsapp_number"
                                        value="{{ $patient->whatsapp_number }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                        min="0"
                                    >
                                    <div class="invalid-feedback" role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tbr_form_box mt-4">
                        <div class="form-group row">
                            <label for="source" class="col-md-6 col-form-label mb-1 mb-md-0">Anda mengetahui haloterapi dari mana?</label>
                            <div class="col-md-6">
                                <select
                                    class="form-control"
                                    id="source"
                                    name="source"
                                    placeholder=""
                                    tabindex=""
                                >
                                    <option title="Select" value="" disabled selected>Select</option>
                                    <option {{ $patient->source === 'Rekomendasi' ? "selected" : "" }} value="Rekomendasi">Rekomendasi</option>
                                    <option {{ $patient->source === 'Voucher' ? "selected" : "" }} value="Voucher">Voucher</option>
                                    <option {{ $patient->source === 'Google Maps' ? "selected" : "" }} value="Google Maps">Google Maps</option>
                                    <option {{ $patient->source === 'WhatsApp' ? "selected" : "" }} value="WhatsApp">WhatsApp</option>
                                    <option {{ $patient->source === 'Facebook' ? "selected" : "" }} value="Facebook">Facebook</option>
                                    <option {{ $patient->source === 'Instagram' ? "selected" : "" }} value="Instagram">Instagram</option>
                                    <option {{ $patient->source === 'TikTok' ? "selected" : "" }} value="TikTok">TikTok</option>
                                    <option {{ $patient->source === 'YouTube' ? "selected" : "" }} value="YouTube">YouTube</option>
                                    <option {{ $patient->source === 'Radio' ? "selected" : "" }} value="Radio">Radio</option>
                                </select>
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tbr_page_title mt-4 mb-4 pt-2">
                        <h4 class="tbr_weight-bold tbr_text-primary mb-1">Nomor Rekening</h4>
                        <p class="mb-0">Untuk memudahkan proses transaksi, kami perlu info nomor rekening Anda.</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="bank_name" class="mb-1">Nama Bank</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="bank_name"
                                    name="bank_name"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="bank_account" class="mb-1">Atas Nama</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="bank_account"
                                    name="bank_account"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="account_number" class="mb-1">Nomor Rekening</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="account_number"
                                    name="account_number"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/patient/referral-activation.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/province.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/regency.js') }}"></script>
    <script>
        $('select').select2();

        /* ======================================
        * Datepicker
        ====================================== */
        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
            language: "id",
            endDate: "0d"
        });
    </script>
    <script>
        $('.tbr_member_nav_referral').addClass('tbr_nav_active');
    </script>
@endsection