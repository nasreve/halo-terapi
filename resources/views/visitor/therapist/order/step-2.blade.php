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
                        <p>Mohon untuk melengkapi data diri pasien pada formulir di bawah.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center no-gutters">
                <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                    <form action="{{ route('therapist.order.step2submit') }}" method="POST" class="needs-validation step2form">
                        @csrf
                        {{-- Personal Data --}}
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name" class="mb-1">Nama Pasien</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        value="{{ session('step2dataSelf')->name }}"
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
                                            value="{{ formatDate(session('step2dataSelf')->date_of_birth, 'd-m-Y') }}"
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
                                    <div class="tbr_radio_group">
                                        <div class="custom-control custom-radio custom-control-inline mb-0">
                                            @if (!session('step2dataSelf')->gender)
                                                <input type="radio" id="male" name="gender" class="custom-control-input" value="Laki-laki" checked>
                                            @else
                                                <input type="radio" id="male" name="gender" class="custom-control-input" value="Laki-laki" {{ session('step2dataSelf')->gender === "Laki-laki" ? "checked" : "" }}>
                                            @endif
                                            <label class="custom-control-label" for="male">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline mb-0">
                                            <input type="radio" id="female" name="gender" class="custom-control-input" value="Perempuan" {{ session('step2dataSelf')->gender === "Perempuan" ? "checked" : "" }}>
                                            <label class="custom-control-label" for="female">Perempuan</label>
                                            <div class="invalid-feedback"></div>
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
                                        <option selected disabled>Select</option>
                                        @foreach ($jobs as $job)
                                            <option value="{{ $job }}" {{ session('step2dataSelf')->job === $job ? "selected" : "" }}>{{ $job }}</option>
                                        @endforeach
                                    </select>
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
                                            value="{{ session('step2dataSelf')->phone_number }}"
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
                                            value="{{ session('step2dataSelf')->whatsapp_number }}"
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
                                    <label for="email" class="mb-1">Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="{{ session('step2dataSelf')->email }}"
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
                                    <label for="province_id" class="mb-1">Provinsi</label>
                                    <select
                                        class="form-control"
                                        id="province_id"
                                        name="province_id"
                                        tabindex=""
                                    >
                                        <option disabled selected>Select</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}" {{ session('step2dataSelf')->province_id == $province->id ? "selected" : "" }}>{{ $province->name }}</option>
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
                                        tabindex=""
                                    >
                                        <option disabled selected>Select</option>
                                        @foreach ($regencies as $regency)
                                            <option value="{{ $regency->id }}" {{ session('step2dataSelf')->regency_id == $regency->id ? "selected" : "" }}>{{ $regency->name }}</option>
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
                                        tabindex=""
                                    >
                                        <option disabled selected>Select</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" {{ session('step2dataSelf')->district_id == $district->id ? "selected" : "" }}>{{ $district->name }}</option>
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
                                        value="{{ session('step2dataSelf')->village }}"
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
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="address"
                                        name="address"
                                        value="{{ session('step2dataSelf')->address }}"
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
                                        id="symptoms"
                                        name="symptoms"
                                        placeholder=""
                                        tabindex=""
                                        spellcheck="false"
                                    >{{ session('step2dataSelf')->symptoms }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <p>Masukkan kode referral Anda jika punya.</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">Ref</div>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="unique_reff"
                                            name="unique_reff"
                                            value="{{ session('step2dataSelf')->unique_reff }}"
                                            placeholder=""
                                            tabindex=""
                                            spellcheck="false"
                                            min="0"
                                        >
                                    </div>
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
                                            @if (session('step2dataSelf')->payment_method)
                                                <input type="radio" id="cash" name="payment_method" value="Cash" class="custom-control-input" {{ session('step2dataSelf')->payment_method === "Cash" ? "checked" : "" }}>
                                            @else
                                                <input type="radio" id="cash" name="payment_method" value="Cash" class="custom-control-input" checked>
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
                                            @if (session('step2dataSelf')->payment_method)
                                                <input type="radio" id="transfer" name="payment_method" value="Transfer" class="custom-control-input" {{ session('step2dataSelf')->payment_method === "Transfer" ? "checked" : "" }}>
                                            @else
                                                <input type="radio" id="transfer" name="payment_method" value="Transfer" class="custom-control-input">
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
    <div class="tbr_wizard_footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tbr_wizard_nav">
                        <a href="{{ route('therapist.order.step-1') }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
                            <i class="icons icon-arrow-left"></i> Sebelumnya
                        </a>
                        <a href="#" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_wizard_next">
                            Selanjutnya <i class="icons icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="confirm-email" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p class=" text-center">
                        Email sudah ada di database kami.
                        <br>
                        Ingin menggunakan data dari email tersebut?
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn tbr_btn tbr_btn-light mr-2" id="dismiss-button" data-dismiss="modal">Tidak</button>
                        <button class="btn tbr_btn tbr_btn-primary" id="use-email-data">Gunakan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('blockfoot')
    <script>
        $('select').select2();

        const sessionDataUrl = "{{ route('therapist.order.step2data') }}";

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
    <script src="{{ asset('assets/js/visitor/therapist/step2-save-to-session.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/therapist/step2-submit-patient-data.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/province.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/regency.js') }}"></script>
    <script>
        const emailUrl = "{{ route('therapist.order.step2email') }}";
        const applyEmailUrl = "{{ route('therapist.order.step2emailApply') }}";
    </script>
    <script src="{{ asset('assets/js/visitor/therapist/order-create-user.js') }}"></script>
@endsection