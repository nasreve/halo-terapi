@extends('visitor.layouts.app')
@section('title', 'Order Step 2')
@section('content')
    <div class="tbr_wizard_header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="tbr_wizard_label">
                        <li class="tbr_active"><span>1</span></li>
                        <li class="tbr_active"><span>2</span></li>
                        <li><span>3</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tbr_wizard_body">
        <div class="container">
            <div class="row justify-content-center no-gutters">
                <div class="col-xl-6 col-lg-6 col-md-10 col-12">
                    <div class="text-center">
                        <h4 class="tbr_weight-extra-bold tbr_section_title mb-1">
                            <span class="tbr_text-primary">Data diri pasien</span>
                        </h4>
                        <p>Mohon untuk melengkapi data diri pada formulir di bawah.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center no-gutters">
                <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                    <form action="{{ route('order.profile.step2submits', request()->route('username')) }}" method="POST" class="step2form needs-validation" autocomplete="off">
                        @csrf
                        {{-- Personal Data --}}
                        <input type="hidden" name="patient_id" value="{{ auth()->guard('patient')->user()->id }}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_name" class="mb-1">Nama Pasien</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="buyer_name"
                                        name="buyer_name"
                                        value="{{ session('step2data')->buyer_name ?? auth()->guard('patient')->user()->name }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"

                                    >
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_age" class="mb-1">Umur</label>
                                    <div class="input-group">
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="buyer_age"
                                            name="buyer_age"
                                            value="{{ session('step2data')->buyer_age ?? Carbon\Carbon::parse(auth()->guard('patient')->user()->date_of_birth)->age }}"
                                            placeholder=""
                                            tabindex=""
                                            spellcheck="false"
                                            min="0"
                                        >
                                        <div class="input-group-append">Tahun</div>
                                        <div class="invalid-feedback"></div>
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
                                            @if (session('step2data')->buyer_gender)
                                                <input type="radio" id="male" name="buyer_gender" class="custom-control-input" value="Laki-laki" {{ session('step2data')->buyer_gender === "Laki-laki" ? "checked" : "" }}>
                                            @else
                                                <input type="radio" id="male" name="buyer_gender" class="custom-control-input" value="Laki-laki" {{ auth()->guard('patient')->user()->gender === "Laki-laki" ? "checked" : "" }}>
                                            @endif
                                            <label class="custom-control-label" for="male">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline mb-0">
                                            @if (session('step2data')->buyer_gender)
                                                <input type="radio" id="female" name="buyer_gender" class="custom-control-input" value="Perempuan" {{ session('step2data')->buyer_gender === "Perempuan" ? "checked" : "" }}>
                                            @else
                                                <input type="radio" id="female" name="buyer_gender" class="custom-control-input" value="Perempuan" {{ auth()->guard('patient')->user()->gender === "Perempuan" ? "checked" : "" }}>
                                            @endif
                                            <label class="custom-control-label" for="female">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_job" class="mb-1">Pekerjaan</label>
                                    <select
                                        class="form-control"
                                        id="buyer_job"
                                        name="buyer_job"
                                        tabindex=""
                                    >
                                        <option disabled>Select</option>
                                        @foreach ($jobs as $job)
                                            @if (session('step2data')->buyer_job)
                                                <option value="{{ $job }}" {{ session('step2data')->buyer_job === $job ? "selected" : "" }}>{{ $job }}</option>
                                            @else
                                                <option value="{{ $job }}" {{ auth()->guard('patient')->user()->job === $job ? "selected" : "" }}>{{ $job }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_phone" class="mb-1">Nomor Telepon</label>
                                    <div class="input-group tbr_fix_ig">
                                        <div class="input-group-prepend">62</div>
                                        <input
                                            type="number"
                                            class="form-control rounded-right"
                                            id="buyer_phone"
                                            name="buyer_phone"
                                            value="{{ session('step2data')->buyer_phone ?? auth()->guard('patient')->user()->phone_number }}"
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
                                    <label for="buyer_whatsapp" class="mb-1">Nomor WhatsApp</label>
                                    <div class="input-group tbr_fix_ig">
                                        <div class="input-group-prepend">62</div>
                                        <input
                                            type="number"
                                            class="form-control rounded-right"
                                            id="buyer_whatsapp"
                                            name="buyer_whatsapp"
                                            value="{{ session('step2data')->buyer_whatsapp ?? auth()->guard('patient')->user()->whatsapp_number }}"
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
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_email" class="mb-1">Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="buyer_email"
                                        name="buyer_email"
                                        value="{{ session('step2data')->buyer_email ?? auth()->guard('patient')->user()->email }}"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                    >
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="text-center mt-3">
                            <p class="mb-1">
                                <img src="{{ asset('/assets/svg/icons/icon_pin_map.svg') }}" alt="Location">&nbsp;
                                <span class="tbr_text-secondary">Alamat Kunjungan</span>
                            </p>
                            <p>Mohon untuk melengkapi alamat tempat tinggal atau lokasi kunjungan.</p>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_province" class="mb-1">Provinsi</label>
                                    <select
                                        class="form-control"
                                        id="buyer_province"
                                        name="buyer_province"
                                        tabindex=""
                                    >
                                        <option disabled selected>Select</option>
                                        @foreach ($provinces as $province)
                                            @if (session('step2data')->buyer_province)
                                                <option value="{{ $province->name }}" {{ session('step2data')->buyer_province === $province->name ? "selected" : "" }}>{{ $province->name }}</option>
                                            @else
                                                <option value="{{ $province->name }}" {{ getProvinceName(auth()->guard('patient')->user()->province_id) === $province->name ? "selected" : "" }}>{{ $province->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <input type="hidden" name="buyer_regency" value="">
                                <div class="form-group">
                                    <label for="buyer_regency" class="mb-1">Kabupaten</label>
                                    <select
                                        class="form-control"
                                        id="buyer_regency"
                                        name="buyer_regency"
                                        tabindex=""
                                    >
                                        <option disabled selected>Select</option>
                                        @foreach ($regencies as $regency)
                                            @if (session('step2data')->hasAttribute('buyer_regency'))
                                                <option value="{{ $regency->name }}" {{ session('step2data')->buyer_regency === $regency->name ? "selected" : "" }}>{{ $regency->name }}</option>
                                            @else
                                                <option value="{{ $regency->name }}" {{ getRegencyName(auth()->guard('patient')->user()->regency_id) === $regency->name ? "selected" : "" }}>{{ $regency->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <input type="hidden" name="buyer_district" value="">
                                <div class="form-group">
                                    <label for="buyer_district" class="mb-1">Kecamatan</label>
                                    <select
                                        class="form-control"
                                        id="buyer_district"
                                        name="buyer_district"
                                        tabindex=""
                                    >
                                        <option disabled selected>Select</option>
                                        @foreach ($districts as $district)
                                            @if (session('step2data')->hasAttribute('buyer_district'))
                                                <option value="{{ $district->name }}" {{ session('step2data')->buyer_district === $district->name ? "selected" : "" }}>{{ $district->name }}</option>
                                            @else
                                                <option value="{{ $district->name }}" {{ getDistrictName(auth()->guard('patient')->user()->district_id) === $district->name ? "selected" : "" }}>{{ $district->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="buyer_sub_district" class="mb-1">Kelurahan</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="buyer_sub_district"
                                        name="buyer_sub_district"
                                        value="{{ session('step2data')->buyer_sub_district ?? auth()->guard('patient')->user()->village }}"
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
                                    <label for="buyer_address" class="mb-1">Detail Alamat</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="buyer_address"
                                        name="buyer_address"
                                        value="{{ session('step2data')->buyer_address ?? auth()->guard('patient')->user()->address }}"
                                        placeholder="Gang, Jalan, RT, RW, Dusun"
                                        tabindex=""
                                        spellcheck="false"
                                    >
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Symptoms --}}
                        <div class="text-center mt-3">
                            <p class="mb-1">
                                <img src="{{ asset('/assets/svg/icons/icon_heartbeet.svg') }}" alt="Symptoms">&nbsp;
                                <span class="tbr_text-secondary">Keluhan Anda</span>
                            </p>
                            <p>Mohon untuk menulis keluhan Anda pada form di bawah.</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <textarea
                                        type="text"
                                        class="form-control tbr_disables_resizing"
                                        id="buyer_symptoms"
                                        name="buyer_symptoms"
                                        value=""
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                    >{{ session('step2data')->buyer_symptoms }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="text-center mt-3">
                            <p class="mb-1">
                                <img src="{{ asset('/assets/svg/icons/icon_credit_card.svg') }}" alt="Payment Method">&nbsp;
                                <span class="tbr_text-secondary">Jenis Pembayaran</span>
                            </p>
                            <p>Kami menyediakan 2 metode pembayaran. Silakan pilih sesuai dengan yang Anda inginkan.</p>
                        </div>
                        <div class="row justify-content-center pt-3">
                            <div class="col-xl-10 col-lg-10 col-md-10 col-12">
                                <div class="form-group pt-1">
                                    <div class="tbr_mega_radio tbr_mega_radio_inline">
                                        <div class="custom-control custom-radio d-flex mb-0">
                                            @if (session('step2data')->buyer_payment_method)
                                                <input type="radio" id="cash" name="buyer_payment_method" value="Cash" class="custom-control-input" {{ session('step2data')->buyer_payment_method === "Cash" ? "checked" : "" }}>
                                            @else
                                                <input type="radio" id="cash" name="buyer_payment_method" value="Cash" class="custom-control-input" checked>
                                            @endif
                                            <label class="custom-control-label" for="cash">
                                                <p class="mb-1 tbr_weight-semi-bold tbr_text-secondary">Cash</p>
                                                <p class="mb-0 tbr_text-grey">
                                                    <em>Bayar langsung ke terapis tanpa melalui bank transfer</em>
                                                </p>
                                                <span class="tbr_mr_border"></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio d-flex mb-0">
                                            @if (session('step2data')->buyer_payment_method)
                                                <input type="radio" id="transfer" name="buyer_payment_method" value="Transfer" class="custom-control-input" {{ session('step2data')->buyer_payment_method === "Transfer" ? "checked" : "" }}>
                                            @else
                                                <input type="radio" id="transfer" name="buyer_payment_method" value="Transfer" class="custom-control-input">
                                            @endif
                                            <label class="custom-control-label" for="transfer">
                                                <p class="mb-1 tbr_weight-semi-bold tbr_text-secondary">Transfer</p>
                                                <p class="mb-0 tbr_text-grey">
                                                    <em>Pembayaran ke haloterapi melalui bank transfer</em>
                                                </p>
                                                <span class="tbr_mr_border"></span>
                                            </label>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="submit-button d-none">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="tbr_wizard_footer tbr_fix_padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tbr_wizard_nav">
                        <a href="{{ route('therapist.profile', request()->route('username')) }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
                            <i class="icons icon-arrow-left"></i> Sebelumnya
                        </a>
                        <a href="javascript:void(0)" anim="ripple" class="btn tbr_btn tbr_btn-danger tbr_wizard_next">
                            Selanjutnya <i class="icons icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('blockfoot')
    <script>
        $('select').select2();

        const sessionDataUrl = "{{ route('order.profile.step2data', request()->route('username')) }}";
    </script>
    <script src="{{ asset('assets/js/visitor/profile-order/step2-province.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/profile-order/step2-regency.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/profile-order/step2-save-to-session.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/profile-order/step2-submit-patient-data.js') }}"></script>
@endsection