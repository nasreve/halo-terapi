<form action="{{ route('therapist.setting.updateService') }}" method="POST" class="main_form mt-2" autocomplete="off">
    @csrf
    <div class="accordion tbr_accordion" id="accordion">
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#collapse-1"
                aria-expanded="true"
                aria-controls="collapse-1"
            >
                <h4 class="w-100 mr-2">Yang anda layani</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <input type="hidden" name="service_id">
            <span class="invalid-feedback tbr_block_invalid_feedback invalid-feedback-service mb-4" role="alert"></span>
            <div id="collapse-1" class="collapse show" data-parent="#accordion">
                <div class="tbr_accordion_content pt-0">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                            <div class="tbr_services">
                                {{-- Yang di loop --}}
                                @foreach ($services as $service)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group tbr_with_checkbox mb-1">
                                                <input
                                                    type="checkbox"
                                                    class="d-none"
                                                    id="service-{{ $service->id }}"
                                                    name="service_id[]"
                                                    value="{{ $service->id }}"
                                                    {{ in_array($service->id, $therapist->services->pluck('id')->toArray()) ? "checked" : "" }}
                                                >
                                                <label for="service-{{ $service->id }}"></label>
                                                <div class="input-group tbr_fix_ig">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $service->title }}"
                                                        disabled
                                                    >
                                                    <div class="input-group-append">
                                                        <img src="{{ asset('/assets/svg/icons/icon_form_uncheck.svg') }}" alt="Uncheck">
                                                        <img src="{{ asset('/assets/svg/icons/icon_form_check.svg') }}" alt="Check">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group tbr_fix_ig">
                                                    <div class="input-group-prepend tbr_bg-light-grey">Rp</div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="rate-{{ $service->id }}"
                                                        name="rate[]"
                                                        value="{{ formatNumberTwoComas(optional(optional($service->therapists->where('id', $therapist->id)->first())->pivot)->rate) }}"
                                                        placeholder=""
                                                        tabindex=""
                                                        disabled
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Jika layanan ditolak oleh admin --}}
                                    @if (optional(optional($service->therapists->where('id', $therapist->id)->first())->pivot)->status === "Ditolak")
                                        <div class="tbr_service-note tbr_text-danger">
                                            <em>Layanan ini ditolak oleh admin. Jika ada pertanyaan silakan hubungi admin.</em>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-2">
                        <div class="col-xl-9 col-lg-9 col-md-10 col-12">
                            <div class="alert alert-warning mb-0" role="alert">
                                Anda ingin mengubah biaya layanan? Silakan langsung menghubungi admin.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#collapse-2"
                aria-expanded="false"
                aria-controls="collapse-2"
            >
                <h4 class="w-100 mr-2">Lokasi pelayanan</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <span class="invalid-feedback tbr_block_invalid_feedback invalid-feedback-location mb-4" role="alert"></span>
            <div id="collapse-2" class="collapse" data-parent="#accordion">
                <div class="tbr_accordion_content pt-0">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-9 col-md-10 col-12">
                                <div class="tbr_location_wrap">
                                    @forelse ($therapist->therapistAreas as $index => $area)
                                        <div class="tbr_area_group" id='element_{{ $index + 1 }}'>
                                            <div class="form-group">
                                                <select
                                                    class="form-control regency"
                                                    id="regency-{{ $index + 1 }}"
                                                    name="regency[]"
                                                    placeholder=""
                                                    tabindex=""
                                                >
                                                    <option value="" selected>Kabupaten</option>
                                                    <option value="{{ $area->regency_id }}" selected>{{ getRegencyName($area->regency_id) }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select
                                                    class="form-control district"
                                                    id="district-{{ $index + 1 }}"
                                                    name="district[]"
                                                    placeholder=""
                                                    tabindex=""
                                                >
                                                    <option value="" selected>Kecamatan</option>
                                                    @foreach (getDistricts($area->regency_id) as $district)
                                                        <option value="{{ $district->id }}" {{ $area->district_id === $district->id ? "selected" : "" }}>{{ getDistrictName($district->id) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn-square remove {{ $therapist->therapistAreas->count() === 1 ? "tbr_disabled" : "" }}" id="{{ "remove_" . ($index + 1) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <g id="Layer_2" data-name="Layer 2" opacity="0.7">
                                                        <g id="close">
                                                            <rect id="Rectangle_1936" data-name="Rectangle 1936" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#f64e60" opacity="0"/>
                                                            <path id="Path_751" data-name="Path 751" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#f64e60"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    @empty
                                        <div class="tbr_area_group" id='element_1'>
                                            <div class="form-group">
                                                <select
                                                    class="form-control regency"
                                                    id="regency-1"
                                                    name="regency[]"
                                                    placeholder=""
                                                    tabindex=""
                                                >
                                                    <option value="" selected>Kabupaten</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select
                                                    class="form-control district"
                                                    id="district-1"
                                                    name="district[]"
                                                    placeholder=""
                                                    tabindex=""
                                                >
                                                    <option value="" selected>Kecamatan</option>
                                                </select>
                                            </div>
                                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn-square remove" id="remove_1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <g id="Layer_2" data-name="Layer 2" opacity="0.7">
                                                        <g id="close">
                                                            <rect id="Rectangle_1936" data-name="Rectangle 1936" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#f64e60" opacity="0"/>
                                                            <path id="Path_751" data-name="Path 751" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#f64e60"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforelse
                                </div>
                            <div class="text-center pt-2">
                                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-success d-inline-block tbr_add_location_service">Tambah Lokasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tbr_accordion_item">
            <button
                class="btn"
                type="button"
                data-toggle="collapse"
                data-target="#collapse-3"
                aria-expanded="false"
                aria-controls="collapse-3"
            >
                <h4 class="w-100 mr-2">Peralatan yang dimiliki</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <input type="hidden" name="equipment">
            <span class="invalid-feedback tbr_block_invalid_feedback mb-4" role="alert"></span>
            <div id="collapse-3" class="collapse" data-parent="#accordion">
                <div class="tbr_accordion_content pt-0">
                    <textarea
                        class="summernote d-none"
                        id="equipment"
                        name="equipment"
                    >{{ $therapist->equipment }}</textarea>
                </div>
            </div>
        </div>
        <div class="tbr_accordion_item">
            <button
                class="btn mb-0"
                type="button"
                data-toggle="collapse"
                data-target="#collapse-4"
                aria-expanded="false"
                aria-controls="collapse-4"
            >
                <h4 class="w-100 mr-2">Maksimal jarak tempuh melayani</h4>
                <div class="tbr_accordion_icon"></div>
            </button>
            <div class="mb-2">
                <input type="hidden" name="max_distance">
                <span class="invalid-feedback tbr_block_invalid_feedback" role="alert"></span>
            </div>
            <div>
                <input type="hidden" name="max_duration">
                <span class="invalid-feedback tbr_block_invalid_feedback" role="alert"></span>
            </div>
            <div id="collapse-4" class="collapse" data-parent="#accordion">
                <div class="tbr_accordion_content tbr_accordion_last">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3 mb-md-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend tbr_bg-light-grey">Jarak</div>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                id="max_distance"
                                                name="max_distance"
                                                value="{{ $therapist->max_distance }}"
                                                placeholder=""
                                                aria-label=""
                                                aria-describedby="basic-addon1"
                                            >
                                            <div class="input-group-append">km</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0 mb-md-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend tbr_bg-light-grey">Waktu Tempuh</div>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                id="max_duration"
                                                name="max_duration"
                                                value="{{ $therapist->max_duration }}"
                                                placeholder=""
                                                aria-label=""
                                                aria-describedby="basic-addon1"
                                            >
                                            <div class="input-group-append">m</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-4 pt-3">
        <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex">Kembali</a>
        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
    </div>
</form>