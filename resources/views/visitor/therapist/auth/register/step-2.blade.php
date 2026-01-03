@extends('visitor.patient.auth.layouts.app')
@section('title', 'Register Step 2')
@section('content')
    <section class="tbr_auth_wrap">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card tbr_card tbr_card-lg">
                        <div class="card-body">
                            <div class="row mb-4 pb-2">
                                <div class="col">
                                    <ul class="tbr_wizard_label">
                                        <li class="tbr_active"><span>1</span></li>
                                        <li class="tbr_active"><span>2</span></li>
                                        <li><span>3</span></li>
                                        <li><span>4</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center">
                                <h4 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Lengkapi Data Personal</h4>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Formulir di bawah ini wajib untuk diisi semua.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('therapist.register.step2submit') }}" method="POST" enctype="multipart/form-data" class="main_form">
                                @csrf
                                {{-- Personal Data --}}
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Nama dan Gelar</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="name"
                                                name="name"
                                                value="{{ $therapist->name }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="str_number" class="mb-1">Nomor STR</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="str_number"
                                                name="str_number"
                                                value="{{ $therapist->str_number }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                <option title="Select" selected disabled>Select</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}" {{ $therapist->province_id === $province->id ? "selected" : "" }}>{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                <option title="Select" disabled selected>Select</option>
                                                @foreach ($regencies as $regency)
                                                    <option value="{{ $regency->id }}" {{ $therapist->regency_id === $regency->id ? "selected" : "" }}>{{ $regency->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                <option title="Select" disabled selected>Select</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" {{ $therapist->district_id === $district->id ? "selected" : "" }}>{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                value="{{ $therapist->village }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
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
                                            >{{ $therapist->address }}</textarea>
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                placeholder="Gang, Jalan, RT, RW, Dusun, Kelurahan, Kecamatan, Kabupaten, Provinsi"
                                                tabindex=""
                                                spellcheck="false"
                                            >{{ $therapist->address_origin }}</textarea>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="religion" class="mb-1">Agama</label>
                                            <select
                                                class="form-control"
                                                id="religion"
                                                name="religion"
                                                placeholder=""
                                                tabindex=""
                                            >
                                                <option disabled selected>Select</option>
                                                <option {{ $therapist->religion === "Islam" ? "selected" : "" }} value="Islam">Islam</option>
                                                <option {{ $therapist->religion === "Protestan" ? "selected" : "" }} value="Protestan">Protestan</option>
                                                <option {{ $therapist->religion === "Katolik" ? "selected" : "" }} value="Katolik">Katolik</option>
                                                <option {{ $therapist->religion === "Hindu" ? "selected" : "" }} value="Hindu">Hindu</option>
                                                <option {{ $therapist->religion === "Buddha" ? "selected" : "" }} value="Buddha">Buddha</option>
                                                <option {{ $therapist->religion === "Khonghucu" ? "selected" : "" }} value="Khonghucu">Khonghucu</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone" class="mb-1">Nomor Telepon</label>
                                            <div class="input-group tbr_fix_ig">
                                                <div class="input-group-prepend">62</div>
                                                <input
                                                    type="number"
                                                    min="0"
                                                    class="form-control rounded-right"
                                                    id="phone"
                                                    name="phone"
                                                    value="{{ $therapist->phone }}"
                                                    placeholder=""
                                                    tabindex=""
                                                    spellcheck="false"
                                                >
                                                <span class="invalid-feedback" role="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="whatsapp" class="mb-1">Nomor WhatsApp</label>
                                            <div class="input-group tbr_fix_ig">
                                                <div class="input-group-prepend">62</div>
                                                <input
                                                    type="number"
                                                    min="0"
                                                    class="form-control rounded-right"
                                                    id="whatsapp"
                                                    name="whatsapp"
                                                    value="{{ $therapist->whatsapp }}"
                                                    placeholder=""
                                                    tabindex=""
                                                    spellcheck="false"
                                                >
                                                <span class="invalid-feedback" role="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="year_of_graduate" class="mb-1">Tahun Lulus</label>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control rounded-right"
                                                id="year_of_graduate"
                                                name="year_of_graduate"
                                                value="{{ $therapist->year_of_graduate }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="photo_path" class="mb-1">Upload Foto Resmi</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="photo_path" type="file" class="custom-file-input" id="photo_path" accept="image/png, image/jpeg, image/jpg">
                                                    <label class="custom-file-label" for="photo_path">{{ $therapist->photo_name ?? "Choose file" }}</label>
                                                    @if ($therapist->photo_path)
                                                        <input name="photo_path" type="hidden" value="{{ $therapist->photo_path }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <span id="photo" class="form-text text-muted mt-2">
                                                <em>
                                                    File yang diupload harus ber-extensi jpg, jpeg, dan png. 400 x 400 pixels dengan size maksimal 1 MB.
                                                </em>
                                            </span>
                                            <span class="invalid-feedback invalid-feedback-photo" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- Work --}}
                                <div class="tbr_page_title mt-4 mb-4 pt-0">
                                    <div class="tbr_small_title mb-1">Tempat Kerja Sekarang</div>
                                    <p class="mb-0">Dimanakah sekarang Anda bekerja?</p>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="job_place" class="mb-1">Nama Tempat Kerja</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="job_place"
                                                name="job_place"
                                                value="{{ $therapist->job_place }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group tbr_fix_ig">
                                            <label for="job_hour" class="mb-1">Jam Kerja</label>
                                            <div class="input-group tbr_fix_ig">
                                                <div class="input-group-prepend">
                                                    <img src="{{ asset('/assets/svg/icons/icon_form_clock.svg') }}" alt="Clock">
                                                </div>
                                                <input
                                                    type="text"
                                                    class="form-control rounded-right"
                                                    id="job_hour"
                                                    name="job_hour"
                                                    value="{{ $therapist->job_hour }}"
                                                    placeholder=""
                                                    tabindex=""
                                                    spellcheck="false"
                                                >
                                                <span class="invalid-feedback" role="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="job_address" class="mb-1">Alamat Tempat Kerja</label>
                                            <textarea
                                                type="text"
                                                class="form-control tbr_disables_resizing"
                                                id="job_address"
                                                name="job_address"
                                                placeholder="Gang, Jalan, RT, RW, Dusun, Kelurahan, Kecamatan, Kabupaten, Provinsi"
                                                tabindex=""
                                                spellcheck="false"
                                            >{{ $therapist->job_address }}</textarea>
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                class="form-control"
                                                id="bank_name"
                                                name="bank_name"
                                                value="{{ $therapist->bank_name }}"
                                                placeholder=""
                                                tabindex=""
                                                spellcheck="false"
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                value="{{ $therapist->bank_account }}"
                                                placeholder=""
                                                tabindex=""
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                value="{{ $therapist->account_number }}"
                                                placeholder=""
                                                tabindex=""
                                            >
                                            <span class="invalid-feedback" role="alert"></span>
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
                                                <option selected disabled>Sumber Informasi</option>
                                                <option {{ $therapist->source === "Rekomendasi" ? "selected" : "" }} value="Rekomendasi">Rekomendasi</option>
                                                <option {{ $therapist->source === "Voucher" ? "selected" : "" }} value="Voucher">Voucher</option>
                                                <option {{ $therapist->source === "Google Maps" ? "selected" : "" }} value="Google Maps">Google Maps</option>
                                                <option {{ $therapist->source === "WhatsApp" ? "selected" : "" }} value="WhatsApp">WhatsApp</option>
                                                <option {{ $therapist->source === "Facebook" ? "selected" : "" }} value="Facebook">Facebook</option>
                                                <option {{ $therapist->source === "Instagram" ? "selected" : "" }} value="Instagram">Instagram</option>
                                                <option {{ $therapist->source === "TikTok" ? "selected" : "" }} value="TikTok">TikTok</option>
                                                <option {{ $therapist->source === "YouTube" ? "selected" : "" }} value="YouTube">YouTube</option>
                                                <option {{ $therapist->source === "Radio" ? "selected" : "" }} value="Radio">Radio</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tbr_wizard_nav justify-content-end mt-4 pt-2">
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_wizard_next">
                                        Selanjutnya <i class="icons icon-arrow-right"></i>
                                    </button>
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
    <script src="{{ asset('assets/js/visitor/therapist/register-ajax-step-2.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/province.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/setting/regency.js') }}"></script>
    <script>
        $("#photo_path").on("change", function (e) {
            let fileSize = this.files[0].size / 1024 / 1024;
            $(this).parents(".input-group").siblings(".invalid-feedback").removeClass("d-block");

            if (fileSize > 1) {
                $(this).parents(".input-group").siblings(".invalid-feedback").addClass("d-block");
                $(this).parents(".input-group").siblings(".invalid-feedback").html('Ukuran file maksimal 1 MB.');

                $(this).val(null);

                setTimeout(() => {
                    $(this).next().html('Choose file');
                }, 100);
            }
        });
    </script>
    <script>
        $('select').select2();
    </script>
@endsection