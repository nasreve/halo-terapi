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
                    <li><span>4</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="tbr_wizard_body">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="text-center mb-4">
                    <img class="mb-4 d-none d-lg-block mr-auto ml-auto" src="{{ asset('/assets/svg/illustration/location.svg') }}" alt="Location">
                    <p class="mb-2 d-none d-lg-block tbr_text-dark tbr_weight-semi-bold">Lokasi Anda</p>
                    <p class="mb-0">
                        <i class="icons icon-location-pin tbr_text-danger d-inlin-block d-lg-none"></i>
                        Kecamatan {{ auth()->guard('patient')->user()->district->name }}, {{ auth()->guard('patient')->user()->regency->name }}, Provinsi {{ auth()->guard('patient')->user()->province->name }}
                    </p>
                </div>
            </div>
            <div class="col-lg-9 tbr_selected_service">
                <form action="" method="POST" class="step2form needs-validation">
                    @csrf
                    <div class="accordion tbr_accordion accordion_patient" id="accordion">
                        @foreach ($services as $service)
                        <div class="tbr_accordion_item" id="tbr_accordion_item_{{ $service->id }}">
                            <button
                                class="btn"
                                type="button"
                                data-toggle="collapse"
                                data-target="#collapse-{{ $service->id }}"
                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                aria-controls="collapse-{{ $service->id }}">
                                <div class="therapist d-flex">
                                    <h4>{{ $service->title }}</h4>
                                    <span><em>Silakan tentukan terapis di Kecamatan Anda!</em></span>
                                    <div class="tbr_accordion_icon"></div>
                                </div>
                                <div class="choose_text">
                                    Silakan tentukan terapis di Kecamatan Anda!
                                </div>
                            </button>
                            <input type="hidden" name="service_{{ $service->id }}" value="{{ selectedTherapistId($service->id) }}" class="main-form">
                            <span class="invalid-feedback invalid-feedback-location tbr_block_invalid_feedback mt-4 mb-3" role="alert"></span>
                            <div id="collapse-{{ $service->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordion">
                                <div class="tbr_accordion_content">
                                    <div class="tbr_service_filter">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <select
                                                        class="form-control"
                                                        id="regency-{{ $service->id }}"
                                                        name="regency-{{ $service->id }}"
                                                        tabindex="">
                                                        <option value="{{ getRegencyIdBySerivce($service->id) }}">{{ getRegencyNameBySerivce($service->id) }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <select
                                                        class="form-control"
                                                        id="district-{{ $service->id }}"
                                                        name="district-{{ $service->id }}"
                                                        tabindex="">
                                                        <option value="" selected>Terapis disemua kecamatan</option>
                                                        @foreach (getDistrictByRegencyId(getRegencyIdBySerivce($service->id)) as $district)
                                                        <option value="{{ $district->id }}" {{ getDistrictIdByService($service->id) == $district->id ? "selected" : "" }}>{{ $district->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="tbr_therapists">
                                                @php
                                                $service_id = $service->id;
                                                $paginatedData = paginateCollection($service->therapists, 5, getCurrentPage($service_id));
                                                @endphp
                                                @forelse($paginatedData as $key => $therapist)
                                                <div class="tbr_therapist">
                                                    <input type="radio" id="service-{{ $loop->parent->iteration }}-{{ $therapist->id }}" name="service_{{ $service_id }}" value="{{ $therapist->id }}" data-service="{{ $service_id }}" class="d-none" {{ selectedTherapist($therapist->id, $service_id) }}>
                                                    <label for="service-{{ $loop->parent->iteration }}-{{ $therapist->id }}" class="radio"></label>
                                                    <div class="tbr_therapist_img">
                                                        @if ($therapist->photo_path)
                                                        <img src="{{ Storage::url($therapist->photo_path) }}" alt="{{ $therapist->name }}">
                                                        @else
                                                        <img src="{{ asset('/assets/images/sample_therapist_01.png') }}" alt="{{ $therapist->name }}">
                                                        @endif
                                                    </div>
                                                    <div class="tbr_therapist_detail">
                                                        <div class="tbr_therapist_name">
                                                            <span>{{ $therapist->name }}</span>
                                                            <span>STR. {{ Str::limit($therapist->str_number, 18, '...') }}</span>
                                                        </div>
                                                        <div class="tbr_therapist_skill">
                                                            @foreach ($therapist->services->take(4) as $service)
                                                            {{ $service->title }}
                                                            {{ $loop->last ? ($therapist->services->count() > 4 ? '...' : '') : ', ' }}
                                                            @endforeach
                                                        </div>
                                                        <div class="tbr_therapist_meta">
                                                            <span>
                                                                <img src="{{ asset('/assets/svg/icons/icon_pin_map.svg') }}" alt="Location">&nbsp;
                                                                {{ $therapist->regency->name }}
                                                            </span>
                                                            <span>
                                                                <span>{{ formatPrice(getServiceDisplayPrice($therapist->id, $service_id)) }}</span>
                                                                {{ $therapist->services->find($service_id)->title }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="tbr_sc_check">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24.3" height="18.245" viewBox="0 0 24.3 18.245">
                                                            <path id="Path_761" data-name="Path 761" d="M12.878,24.2a1.515,1.515,0,0,1-1.106-.485L4.41,15.884a1.516,1.516,0,1,1,2.212-2.075l6.241,6.65L25.6,6.523a1.515,1.515,0,1,1,2.242,2.03L14,23.7a1.515,1.515,0,0,1-1.106.5Z" transform="translate(-3.999 -5.956)" fill="#ddd"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                {{-- {{ dd(session('therapistRegencies')[$key]) }} --}}
                                                @empty
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-8 col-lg-9 col-md-10 col-12">
                                                        {{-- {{ dd(session('therapistDistricts')) }} --}}
                                                        @forelse (session('therapistDistricts') as $key => $districts)
                                                        @php
                                                        $dist = $districts['district_id'];
                                                        @endphp
                                                        @empty
                                                        @php
                                                        $dist = "";
                                                        @endphp
                                                        @endforelse
                                                        @if ($dist == "" || $dist == null)
                                                        <div class="alert alert-warning text-center" role="alert">
                                                            Saat ini belum tersedia terapis di kabupaten yang anda maksud. Silakan pilih kabupaten lain dengan lokasi terdekat Anda.
                                                        </div>
                                                        @else
                                                        <div class="alert alert-warning text-center" role="alert">
                                                            Saat ini belum tersedia terapis di kecamatan yang anda maksud. Silakan pilih kecamatan lain dengan lokasi terdekat Anda.
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforelse
                                                {{ $paginatedData->onEachSide(1)->links('visitor.patient.order.step-2-pagination', [
                                                        'service_id' => $service_id
                                                    ]) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row justify-content-center">
                                            <div class="col-xl-8 col-lg-9 col-md-10 col-12">
                                                <div class="alert alert-warning text-center" role="alert">
                                                    Saat ini belum tersedia terapis di kecamatan maupun di kabupaten Anda.
                                                    Silakan menghubungi admin Haloterapi.
                                                </div>
                                            </div>
                                        </div> --}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
                    <a href="{{ route('home') }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
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
<script src="{{ asset('assets/js/visitor/step2-submit-choosen-therapist.js') }}"></script>
<script src="{{ asset('assets/js/visitor/step2-choosen-therapist.js') }}"></script>
@foreach ($services as $service)
<script>
    $(document).on("click", ".{{ $service->id }}_link", function(e) {
        if ($(this).hasClass("tbr_disabled")) {
            return false;
        }

        e.preventDefault();
        $.ajax({
            url: $(this).find(".page-link").attr("href"),
        }).done(function(res) {
            $("#tbr_accordion_item_{{ $service->id }}").find('.tbr_therapists').replaceWith($(res).find("#tbr_accordion_item_{{ $service->id }}").find(".tbr_therapists"));
        }).fail(function() {
            window.location.reload();
        });
    });
</script>
<script>
    $("#regency-{{ $service->id }}").select2({
        ajax: {
            url: '/regency',
            type: 'POST',
            delay: 250,
            data: function(params) {
                var query = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: params.term,
                    type: 'public'
                }

                return query;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
</script>
<script>
    $("#district-{{ $service->id }}").select2();
    $("#regency-{{ $service->id }}").on("select2:select", function() {
        $.ajax({
            url: '/patient/order/step-2?regency_id=' + $(this).val() + '&service_id=' + "{{ $service->id }}"
        }).done(function(res) {
            $("#tbr_accordion_item_{{ $service->id }}").find('.tbr_therapists').replaceWith($(res).find("#tbr_accordion_item_{{ $service->id }}").find(".tbr_therapists"));
        }).fail(function() {
            window.location.reload();
        });

        $.ajax({
            url: "/district/" + $(this).val(),
            type: "GET",
        }).done(function(res) {
            if (res) {
                $('#district-{{ $service->id }}').empty();
                $('#district-{{ $service->id }}').append('<option selected value="">Terapis disemua kecamatan</option>');
                $.each(res, function(key, value) {
                    $('#district-{{ $service->id }}')
                        .append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                });
            } else {
                $('#district-{{ $service->id }}').empty();
            }
        }).fail(function() {
            window.location.reload();
        });
    });

    $("#district-{{ $service->id }}").on("change", function() {
        $.ajax({
            url: '/patient/order/step-2?district_id=' + $(this).val() + '&service_id=' + "{{ $service->id }}"
        }).done(function(res) {
            $("#tbr_accordion_item_{{ $service->id }}").find('.tbr_therapists').replaceWith($(res).find("#tbr_accordion_item_{{ $service->id }}").find(".tbr_therapists"));
        }).fail(function() {
            window.location.reload();
        });
        // if($(this).val() !== 'Terapis disemua kecamatan' || $(this).val() !== 'Kecamatan'){
        //     // console.log('jalan');
        //     // $('.regency-none-{{ $service->id }}').addClass('d-none');
        //     $('.district-none-{{ $service->id }}').removeClass('d-none');
        // }
    });
</script>
@endforeach
@endsection