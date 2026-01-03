@extends('visitor.layouts.app')
@section('title', 'Pengaturan')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/summernote/summernote-bs4.css') }}" />
@endsection
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
            @include('visitor.layouts.therapist-aside')
            <div class="tbr_member_content_body">
                <div class="tbr_page_title mb-4">
                    <h4 class="tbr_weight-bold tbr_text-primary mb-1">Pengaturan</h4>
                    <p class="mb-0">Anda dapat merubah data pribadi, pengalaman, layanan, nomor rekening serta waktu pelayanan.</p>
                </div>
                <ul class="nav nav-tabs tbr_nav_tabs justify-content-center mt-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="personal-data-tab" data-toggle="tab" href="#personal-data" role="tab" aria-controls="personal-data" aria-selected="true">Data Pribadi</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Pengalaman</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="false">Layanan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="service-schedule-tab" data-toggle="tab" href="#service-schedule" role="tab" aria-controls="service-schedule" aria-selected="false">Waktu Pelayanan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="bank-account-tab" data-toggle="tab" href="#bank-account" role="tab" aria-controls="bank-account" aria-selected="false">Rekening</a>
                    </li>
                </ul>
                <div class="tab-content tbr_tab_content" id="TabContent">
                    <div class="tab-pane fade show active" id="personal-data" role="tabpanel" aria-labelledby="personal-data-tab">
                        @include('visitor.therapist.setting.partials.personal-data')
                    </div>
                    <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                        @include('visitor.therapist.setting.partials.experience')
                    </div>
                    <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
                        @include('visitor.therapist.setting.partials.service')
                    </div>
                    <div class="tab-pane fade" id="service-schedule" role="tabpanel" aria-labelledby="service-schedule-tab">
                        @include('visitor.therapist.setting.partials.service-schedule')
                    </div>
                    <div class="tab-pane fade" id="bank-account" role="tabpanel" aria-labelledby="bank-account-tab">
                        @include('visitor.therapist.setting.partials.bank-account')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/therapist/update-setting.js') }}"></script>
	<script src="{{ asset('porto/vendor/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/js/province.js') }}"></script>
    <script src="{{ asset('assets/js/regency.js') }}"></script>
    <script>
        $("#province_id").select2();
        $("#regency_id").select2();
        $("#district_id").select2();
        $("#religion").select2();
        $("#source").select2();
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
                        '</div>' +
                        '<div class="form-group">' +
                            '<select class="form-control district" id="district-'+ nextindex +'" name="district[]" placeholder="" tabindex="">' +
                                '<option value="" selected>Kecamatan</option>' +
                            '</select>' +
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
    <script>
        // $(function () {
        //     $("html, body").animate({ scrollTop: 0 }, "fast");
        // })

        $('.tbr_member_nav_setting').addClass('tbr_nav_active');
    </script>
@endsection