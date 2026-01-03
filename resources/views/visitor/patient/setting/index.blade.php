@extends('visitor.layouts.app')
@section('title', 'Pengaturan')
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
                <form action="{{ route('patient.setting.update') }}" method="POST" class="main_form" autocomplete="off">
                    @csrf
                    <div class="tbr_page_title mb-4">
                        <h4 class="tbr_weight-bold tbr_text-primary mb-1">Pengaturan</h4>
                        <p class="mb-0">Anda dapat mengubah data pribadi melalui form di bawah ini.</p>
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
                                <div class="invalid-feedback"></div>
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
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="age" class="mb-2">Jenis Kelamin</label>
                                <input type="hidden" name="gender">
                                <div class="invalid-feedback mt-0 mb-2" role="alert"></div>
                                <div class="tbr_radio_group">
                                    <div class="custom-control custom-radio custom-control-inline mb-0">
                                        <input type="radio" id="male" name="gender" class="custom-control-input" value="Laki-laki" {{ $patient->gender === "Laki-laki" ? "Checked" : "" }}>
                                        <label class="custom-control-label" for="male">Laki-Laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-0">
                                        <input type="radio" id="female" name="gender" class="custom-control-input"  value="Perempuan" {{ $patient->gender === "Perempuan" ? "Checked" : "" }}>
                                        <label class="custom-control-label" for="female">Perempuan</label>
                                    </div>
                                </div>
                            </div>
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
                                    <option selected disabled title="Select">Select</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job }}" {{ $patient->job === $job ? "selected" : "" }}>{{ $job }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    {{-- start : Form ini muncul ketika program REFERRAL nya active --}}
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
                                    <option disabled selected title="Select">Select</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $patient->province_id === $province->id ? "selected" : "" }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
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
                                    <option title="Select" selected disabled>Select</option>
                                    @foreach ($regencies as $regency)
                                        <option value="{{ $regency->id }}" {{ $patient->regency_id === $regency->id ? "selected" : "" }}>{{ $regency->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
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
                                    <option title="Select" selected disabled>Select</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $patient->district_id === $district->id ? "selected" : "" }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
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
                                <div class="invalid-feedback"></div>
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
                                    placeholder="Gang, Jalan, RT, RW, Dusun"
                                    tabindex=""
                                    spellcheck="false"
                                >{{ $patient->address }}</textarea>
                                <div class="invalid-feedback"></div>
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
                                    value=""
                                    placeholder="Gang, Jalan, RT, RW, Dusun, Kelurahan, Kecamatan, Kabupaten, Provinsi"
                                    tabindex=""
                                    spellcheck="false"
                                >{{ $patient->address_origin }}</textarea>
                                <div class="invalid-feedback"></div>
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
                                    <div class="invalid-feedback"></div>
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
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($patient->referrer()->exists())
                        {{-- start : Form ini muncul ketika program REFERRAL nya active --}}
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="business_community" class="mb-1">Komunitas Bisnis</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="business_community"
                                        name="business_community"
                                        value="{{ $patient->referrer->business_community }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                    >
                                    <div class="invalid-feedback"></div>
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
                                        value="{{ $patient->referrer->business_name }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                    >
                                    <div class="invalid-feedback"></div>
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
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                    >{{ $patient->referrer->business_address }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        {{-- end : Form ini muncul ketika program REFERRAL nya active --}}
                    @endif
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
                                    <option title="Select" disabled selected>Select</option>
                                    <option value="Rekomendasi" {{ $patient->source === "Rekomendasi" ? "Selected" : "" }}>Rekomendasi</option>
                                    <option value="Voucher" {{ $patient->source === "Voucher" ? "Selected" : "" }}>Voucher</option>
                                    <option value="Google Maps" {{ $patient->source === "Google Maps" ? "Selected" : "" }}>Google Maps</option>
                                    <option value="WhatsApp" {{ $patient->source === "WhatsApp" ? "Selected" : "" }}>WhatsApp</option>
                                    <option value="Facebook" {{ $patient->source === "Facebook" ? "Selected" : "" }}>Facebook</option>
                                    <option value="Instagram" {{ $patient->source === "Instagram" ? "Selected" : "" }}>Instagram</option>
                                    <option value="TikTok" {{ $patient->source === "TikTok" ? "Selected" : "" }}>TikTok</option>
                                    <option value="YouTube" {{ $patient->source === "YouTube" ? "Selected" : "" }}>YouTube</option>
                                    <option value="Radio" {{ $patient->source === "Radio" ? "Selected" : "" }}>Radio</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tbr_page_title mt-4 mb-4 pt-2">
                        <h4 class="tbr_weight-bold tbr_text-primary mb-1">Data akun</h4>
                        <p class="mb-0">Anda hanya diperbolehkan untuk mengubah password saja.</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="email" class="mb-1">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ $patient->email }}"
                                    placeholder=""
                                    tabindex=""
                                    spellcheck="false"
                                    disabled
                                >
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="password" class="mb-1">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    value=""
                                    placeholder=""
                                    tabindex=""
                                >
                                <div class="invalid-feedback"></div>
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
                                >
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button onclick="window.location.href = '{{ url()->previous() }}'" type="button" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex">Kembali</button>
                        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/patient/update-setting.js') }}"></script>
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
        $('.tbr_member_nav_setting').addClass('tbr_nav_active');
    </script>
@endsection