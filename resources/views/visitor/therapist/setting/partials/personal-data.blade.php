<form action="{{ route('therapist.setting.updatePersonalData') }}" method="POST" class="main_form" autocomplete="off">
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
                    <option title="Select" disabled selected>Select</option>
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
                        class="form-control rounded-right"
                        id="phone"
                        name="phone"
                        value="{{ $therapist->phone }}"
                        placeholder=""
                        tabindex=""
                        spellcheck="false"
                        min="0"
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
                        class="form-control rounded-right"
                        id="whatsapp"
                        name="whatsapp"
                        value="{{ $therapist->whatsapp }}"
                        placeholder=""
                        tabindex=""
                        spellcheck="false"
                        min="0"
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
                    class="form-control rounded-right"
                    id="year_of_graduate"
                    name="year_of_graduate"
                    value="{{ $therapist->year_of_graduate }}"
                    placeholder=""
                    tabindex=""
                    spellcheck="false"
                    min="0"
                >
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
    </div>
    @if ($therapist->referrer()->exists())
        {{-- start : Jika terapis mengaktifkan program referralnya bro... --}}
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="business_community" class="mb-1">Komunitas Bisnis</label>
                    <input
                        type="text"
                        class="form-control"
                        id="business_community"
                        name="business_community"
                        value="{{ $therapist->referrer->business_community }}"
                        placeholder=""
                        tabindex=""
                        spellcheck="false"
                    >
                    <span class="invalid-feedback" role="alert"></span>
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
                        value="{{ $therapist->referrer->business_name }}"
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
                    >{{ $therapist->referrer->business_address }}</textarea>
                    <span class="invalid-feedback" role="alert"></span>
                </div>
            </div>
        </div>
        {{-- end : Jika terapis mengaktifkan program referralnya bro... --}}
    @endif
    {{-- Work --}}
    <hr class="tbr_solid mb-4">
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
                        class="form-control"
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
                    <option selected disabled>Select</option>
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
    {{-- App Account --}}
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
                    value="{{ $therapist->email }}"
                    placeholder=""
                    tabindex=""
                    spellcheck="false"
                    disabled
                >
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <label for="username" class="mb-1">Username</label>
                <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    value="{{ $therapist->username }}"
                    placeholder=""
                    tabindex=""
                    spellcheck="false"
                    disabled
                >
                <span class="invalid-feedback" role="alert"></span>
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
                <span class="invalid-feedback" role="alert"></span>
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
        <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex">Kembali</a>
        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
    </div>
</form>