@extends('visitor.patient.auth.layouts.app')
@section('title', 'Register Step 4')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/summernote/summernote-bs4.css') }}" />
@endsection
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
                                        <li class="tbr_active"><span>3</span></li>
                                        <li class="tbr_active"><span>4</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center">
                                <h4 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Layanan</h4>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Silakan atur data pelayanan terapis Anda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('therapist.register.step4submit') }}" method="POST" class="main_form">
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
                                        <div class="rate-validation">
                                            <span class="invalid-feedback invalid-feedback-rate tbr_block_invalid_feedback my-4" role="alert"></span>
                                        </div>
                                        <input type="hidden" name="service_id">
                                        <span class="invalid-feedback tbr_block_invalid_feedback my-4" role="alert"></span>
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
                                                                            >
                                                                            <label for="service-{{ $service->id }}" id="label-service-{{ $service->id }}"></label>
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
                                                                                <div class="input-group-prepend">Rp</div>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control number-separator"
                                                                                    id="rate-{{ $service->id }}"
                                                                                    name="rate[]"
                                                                                    value=""
                                                                                    placeholder=""
                                                                                    tabindex=""
                                                                                    spellcheck="false"
                                                                                    disabled
                                                                                    autocomplete="off"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
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
                                        <span class="invalid-feedback invalid-feedback-location tbr_block_invalid_feedback my-4" role="alert"></span>
                                        <div id="collapse-2" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content pt-0">
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-9 col-lg-9 col-md-10 col-12">
                                                        <div class="tbr_location_wrap">
                                                            <div class="tbr_area_group" id='element_1'>
                                                                <div class="form-group mb-1">
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
                                                                        <option selected disabled>Kecamatan</option>
                                                                    </select>
                                                                </div>
                                                                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn-square remove tbr_disabled" id="remove_1">
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
                                        <span class="invalid-feedback tbr_block_invalid_feedback my-4" role="alert"></span>
                                        <div id="collapse-3" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content pt-0">
                                                <textarea
                                                    class="summernote d-none"
                                                    id="equipment"
                                                    name="equipment"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbr_accordion_item">
                                        <button
                                            class="btn"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-4"
                                            aria-expanded="false"
                                            aria-controls="collapse-4"
                                        >
                                            <h4 class="w-100 mr-2">Jadwal pelayanan home care</h4>
                                            <div class="tbr_accordion_icon"></div>
                                        </button>
                                        <input type="hidden" name="homecare">
                                        <span class="invalid-feedback tbr_block_invalid_feedback my-4" role="alert"></span>
                                        <div id="collapse-4" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content pt-0">
                                                <div class="text-center">
                                                    <p><em>Kesepakatan hari & tanggal kunjungan dapat disepakati secara manual antara terapis dengan pasien.</em></p>
                                                </div>
                                                <textarea
                                                    class="summernote d-none"
                                                    id="homecare"
                                                    name="homecare"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbr_accordion_item">
                                        <button
                                            class="btn mb-0"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-5"
                                            aria-expanded="false"
                                            aria-controls="collapse-5"
                                        >
                                            <h4 class="w-100 mr-2">Maksimal jarak tempuh melayani</h4>
                                            <div class="tbr_accordion_icon"></div>
                                        </button>
                                        <div class="p-0 m-0">
                                            <div class="tbr_distance_acc">
                                                <input type="hidden" name="max_distance">
                                                <span class="invalid-feedback tbr_block_invalid_feedback m-0" role="alert"></span>
                                            </div>
                                            <div class="tbr_distance_acc">
                                                <input type="hidden" name="max_duration">
                                                <span class="invalid-feedback tbr_block_invalid_feedback m-0" role="alert"></span>
                                            </div>
                                        </div>
                                        <div id="collapse-5" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content tbr_accordion_last">
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend tbr_bg-light-grey">Jarak</div>
                                                                        <input
                                                                            type="number"
                                                                            class="form-control"
                                                                            id="max_distance"
                                                                            name="max_distance"
                                                                            placeholder=""
                                                                            aria-label=""
                                                                            aria-describedby="basic-addon1"
                                                                            min="0"
                                                                        >
                                                                        <div class="input-group-append">km</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend tbr_bg-light-grey">Waktu Tempuh</div>
                                                                        <input
                                                                            type="number"
                                                                            class="form-control"
                                                                            id="max_duration"
                                                                            name="max_duration"
                                                                            placeholder=""
                                                                            aria-label=""
                                                                            aria-describedby="basic-addon1"
                                                                            min="0"
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
                                <div class="tbr_wizard_nav mt-4 pt-2">
                                    <a href="{{ route('therapist.register.step-3') }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
                                        <i class="icons icon-arrow-left"></i> Sebelumnya
                                    </a>
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
    <script src="{{ asset('porto/vendor/autoNumeric-4.6.0/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/therapist/register-ajax-step-4.js') }}"></script>
	<script src="{{ asset('porto/vendor/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(".number-separator").each(function() {
            new AutoNumeric(this, {
                allowDecimalPadding: false,
                minimumValue: 0,
                decimalCharacter: ",",
                digitGroupSeparator: ".",
                defaultValueOverride: "",
                modifyValueOnWheel: false
            });
        });

        $(".tbr_with_checkbox").each(function(index) {
            $(this).find("label").on("click", function() {
                const number = index + 1;

                if ($(`#rate-${number}`).attr("disabled")) {
                    $(`#rate-${number}`).removeAttr("disabled");
                } else {
                    $(`#rate-${number}`).val("");
                    $(`#rate-${number}`).attr("disabled", "");
                }
            })
        });
    </script>
    <script>
        $(".summernote").summernote({
            styleWithSpan: false,
            minHeight: 160,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    </script>
    <script>
        $(document).ready(function(){

            initailizeSelect2();

            // Finding total number of elements added
            var total_element = $(".tbr_area_group").length;

            // Add new element
            $(".tbr_add_location_service").click(function(){
                total_element = total_element + 1;

                if (total_element > 1) {
                    $(".tbr_area_group:first").find("button").removeClass('tbr_disabled');
                }

                console.log(total_element);

                // last <div> with element class id
                var lastid = $(".tbr_area_group:last").attr("id");
                var split_id = lastid.split("_");
                var nextindex = Number(split_id[1]) + 1;

                var max = 20;
                    // Check total number elements

                    if(total_element < max ){
                    // Adding new div container after last occurance of element class
                    $(".tbr_area_group:last").after(
                        '<div class="tbr_area_group" id="element_'+ nextindex +'"></div>'
                    );

                    // Adding element to <div>
                    $("#element_" + nextindex).append(
                        '<div class="form-group mb-1">' +
                            '<select class="form-control regency" id="regency-'+ nextindex +'" name="regency[]" placeholder="" tabindex="">' +
                                '<option value="" selected>Kabupaten</option>' +
                            '</select>' +
                            '<span class="invalid-feedback" role="alert"></span>' +
                        '</div>' +
                        '<div class="form-group">' +
                            '<select class="form-control district" id="district-'+ nextindex +'" name="district[]" placeholder="" tabindex="">' +
                                '<option value="" selected>Kecamatan</option>' +
                            '</select>' +
                            '<span class="invalid-feedback" role="alert"></span>' +
                        '</div>' +
                        '<button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn-square remove" id="remove_'+ nextindex +'">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">' +
                                '<g id="Layer_2" data-name="Layer 2" opacity="0.7">' +
                                    '<g id="close">' +
                                        '<rect id="Rectangle_1936" data-name="Rectangle 1936" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#f64e60" opacity="0"/>' +
                                        '<path id="Path_751" data-name="Path 751" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#f64e60"/>' +
                                    '</g>' +
                                '</g>' +
                            '</svg>' +
                        '</button>'
                    );
                    initailizeSelect2();
                }
            });

            $('.tbr_location_wrap').on('click', '.remove', function(){
                if (total_element == 1) {
                    return false;
                }

                var id = this.id;
                var split_id = id.split("_");
                var deleteindex = split_id[1];

                // Remove <div> with id
                $("#element_" + deleteindex).remove();

                total_element = total_element - 1;

                console.log(total_element);

                $(".tbr_area_group").each(function (index) {
                    $(this).attr("id", `element_${index + 1}`);
                    $(this).find("[name='regency[]']").attr("id", `regency-${index + 1}`);
                    $(this).find("[name='district[]']").attr("id", `district-${index + 1}`);
                    $(this).find("button").attr("id", `remove_${index + 1}`);
                    initailizeSelect2();
                    if (total_element == 1) {
                        $(this).find("button").addClass('tbr_disabled');
                    }
                });
            });
        });

        // Initialize select2
        function initailizeSelect2(){
            $("select.regency").each(function (index) {
                $(this).off('select2:select');

                $(this).select2({
                    ajax: {
                        url: '/regency',
                        type: 'POST',
                        delay: 250,
                        data: function (params) {
                            var query = {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                search: params.term,
                                type: 'public'
                            }

                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });

                $(this).on("select2:select", function () {
                    $.ajax({
                        url: "/district/" + $(this).val(),
                        type: "GET",
                    }).done(function (res) {
                        if (res) {
                            $(`#district-${index + 1}`).empty();
                            $(`#district-${index + 1}`).append('<option value="" selected>Kecamatan</option>');
                            $.each(res, function (key, value) {
                                $(`#district-${index + 1}`)
                                    .append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                            });
                        } else {
                            $(`#district-${index + 1}`).empty();
                        }
                    }).fail(function () {
                        window.location.reload();
                    });
                })
            });

            $("select.district").select2();
        }
    </script>
@endsection