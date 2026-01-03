@extends('visitor.layouts.app')
@section('title', 'Profil Terapis')
@section('openMemberAside')
    <div class="container-fluid tbr_open_member_aside" anim="ripple">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            Lihat foto dan detail terapis
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
            @include('visitor.layouts.therapist-profile-aside')
            <div class="tbr_member_content_body">
                <div class="text-center text-xl-left mb-4 pb-xl-0">
                    <h4 class="tbr_weight-bold tbr_text-primary mb-0">{{ $therapist->name }}</h4>
                </div>
                <div class="tbr_box_list">
                    <div class="tbr_box_list_item">
                        <img src="{{ asset('/assets/svg/icons/icon_profile_str.svg') }}" alt="STR Number">
                        <div class="tbr_box_icon_desc">
                            <div class="tbr_text-secondary">Nomor STR</div>
                            <span
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="{{ $therapist->str_number }}"
                                data-html="true"
                            >{{ Str::limit($therapist->str_number, 18, ' ...') ?? 'Data belum lengkap' }}</span>
                        </div>
                    </div>
                    <div class="tbr_box_list_item">
                        <img src="{{ asset('/assets/svg/icons/icon_profile_address.svg') }}" alt="Address">
                        <div class="tbr_box_icon_desc">
                            <div class="tbr_text-secondary">Domisili</div>
                            <span
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Kecamatan {{ $therapist->district->name }}"
                                data-html="true"
                            >{{ Str::limit('Kecamatan ' . $therapist->district->name, 18, ' ...') ?? 'Data belum lengkap' }}</span>
                            {{-- <span>Kecamatan {{ $therapist->district->name ?? 'Data belum lengkap' }}</span> --}}
                        </div>
                    </div>
                    <div class="tbr_box_list_item tbr_box_list_dropdown">
                        <img src="{{ asset('/assets/svg/icons/icon_profile_homecare.svg') }}" alt="Homecare">
                        <div class="tbr_box_icon_desc">
                            <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="tbr_text-secondary">Homecare</div>
                                <span class="tbr_text-grey">
                                    Lihat jadwal pelayanan
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.227" height="5.112" viewBox="0 0 10.227 5.112">
                                        <path id="Path_3" data-name="Path 3" d="M12.256,15.225a.73.73,0,0,1-.57-.27L8.159,10.573a.73.73,0,0,1,0-.928l3.652-4.382a.731.731,0,1,1,1.125.935L9.671,10.112l3.155,3.915a.73.73,0,0,1-.57,1.2Z" transform="translate(-5 13.105) rotate(-90)" fill="#7e8299"/>
                                    </svg>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                                {!! $therapist->homecare ?? 'Data belum lengkap' !!}
                                {{-- {{ $therapist->job_hour ?? 'Data belum lengkap' }} --}}
                            </div>
                        </div>
                    </div>
                    <div class="tbr_box_list_item">
                        <img src="{{ asset('/assets/svg/icons/icon_profile_religion.svg') }}" alt="Religion">
                        <div class="tbr_box_icon_desc">
                            <div class="tbr_text-secondary">Agama</div>
                            <span>{{ $therapist->religion ?? 'Data belum lengkap' }}</span>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs tbr_nav_tabs justify-content-center mt-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="true">Layanan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Pendidikan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="workshop-tab" data-toggle="tab" href="#workshop" role="tab" aria-controls="workshop" aria-selected="false">Workshop</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Pengalaman PKL</a>
                    </li>
                </ul>
                <div class="tab-content tbr_tab_content" id="TabContent">
                    <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                        <div class="text-center mb-4 pb-2">
                            <em>Tinggal pilih layanan di bawah yang sesuai, tanpa harus pergi ke klinik.</em>
                        </div>
                        <div class="tbr_services_column">
                            <div class="row">
                                @php
                                    $paginatedData = paginateCollection($therapist->services, 6, $servicePage)
                                @endphp
                                @forelse ($paginatedData as $service)
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-6 tbr_column">
                                        <div class="tbr_service_card">
                                            <input type="checkbox" id="service_{{ $service->id }}" name="service_{{ $service->id }}" value="{{ $service->id }}" value="1" class="d-none" {{ checkedOrderTherapist($service->id, $therapist->username) }}>
                                            <label for="service_{{ $service->id }}" class="radio" anim="ripple"></label>
                                            <div class="tbr_sc_check">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.3" height="18.245" viewBox="0 0 24.3 18.245">
                                                    <path id="Path_761" data-name="Path 761" d="M12.878,24.2a1.515,1.515,0,0,1-1.106-.485L4.41,15.884a1.516,1.516,0,1,1,2.212-2.075l6.241,6.65L25.6,6.523a1.515,1.515,0,1,1,2.242,2.03L14,23.7a1.515,1.515,0,0,1-1.106.5Z" transform="translate(-3.999 -5.956)" fill="#ddd"/>
                                                </svg>
                                            </div>
                                            <h4>{{ $service->title }}</h4>
                                            <p>{{ Str::limit($service->description, 65, $end='...') }}</p>
                                            <a href="" class="tbr_text-success d-block mb-2" data-toggle="modal" data-target="#modal-service-{{ $service->id }}"><em>Selengkapnya</em></a>
                                            <div class="mb-4 tbr_service_card_price">{{ formatPrice($service->pivot->rate) }}</div>
                                            <div class="tbr_btn_group">
                                                <button type="button" class="btn tbr_btn tbr_btn-success tbr_btn_order">Pesan</button>
                                                <button type="button" class="btn tbr_btn tbr_btn-light-danger tbr_btn_cancel">Batalkan</button>
                                            </div>
                                        </div>

                                        @include('visitor.partials.modal-service-therapist', ['service' => $service])
                                    </div>
                                @empty
                                    <div class="col">
                                        <div class="alert alert-warning d-flex align-items-center justify-content-center mb-4" role="alert">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span>
                                                    Terapis ini belum memiliki layanan.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        @if ($paginatedData->lastPage() > 1)
                            <nav aria-label="Page navigation" class="mt-3 mb-0 pt-2">
                                <ul class="pagination tbr_pagination m-auto justify-content-center">
                                    <li class="page-item {{ ($paginatedData->currentPage() == 1) ? ' tbr_disabled' : '' }}">
                                        <a class="page-link" href="{{ route('therapist.profile', ['username' => request()->route('username'), 'page' => $paginatedData->currentPage()-1 ]) }}">
                                            <img src="{{ asset('/assets/svg/icons/icon_paginate_prev.svg') }}" alt="Previous">
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $paginatedData->lastPage(); $i++)
                                        <li class="page-item {{ ($paginatedData->currentPage() == $i) ? ' tbr_active' : '' }}">
                                            <a class="page-link" href="{{ route('therapist.profile', ['username' => request()->route('username'), 'page' => $i ]) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ ($paginatedData->currentPage() == $paginatedData->lastPage()) ? ' tbr_disabled' : '' }}">
                                        <a class="page-link" href="{{ route('therapist.profile', ['username' => request()->route('username'), 'page' => $paginatedData->currentPage()+1 ]) }}">
                                            <img src="{{ asset('/assets/svg/icons/icon_paginate_next.svg') }}" alt="Next">
                                        </a>
                                    </li>
                                </ul>
                            <nav aria-label="Page navigation" class="m-0 p-0">
                        @endif
                    </div>
                    <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                        <div class="text-center mb-4 pb-0">
                            <em>Riwayat pendidikan formal yang dimikili oleh tenaga ahli kami.</em>
                        </div>
                        <div class="tbr_card_border tbr_therapist_history px-4 py-3">
                            {!! $therapist->edu_history !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="workshop" role="tabpanel" aria-labelledby="workshop-tab">
                        <div class="text-center mb-4 pb-0">
                            <em>Riwayat seminar dan pelatihan yang sudah diikuti.</em>
                        </div>
                        <div class="tbr_card_border tbr_therapist_history px-4 py-3">
                            {!! $therapist->workshop_history !!}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                        <div class="text-center mb-4 pb-0">
                            <em>Berikut daftar pengalaman kerja praktik yang pernah dilakukan.</em>
                        </div>
                        <div class="tbr_card_border tbr_therapist_history px-4 py-3">
                            {!! $therapist->job_experience !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('visitor.includes.therapist-cart')
@endsection
@section('blockfoot')
    <script>
        const username = "{{ request()->route('username') }}";
        const url = "{{ route('therapist.order', request()->route('username')) }}"
    </script>
    <script src="{{ asset('assets/js/visitor/login.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/profile-order/order.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/profile-order/pagination.js') }}"></script>
    <script>
        /* ======================================
        * Fix positioning floting whatsapp
        ====================================== */
        if ( $(".tbr_cart").hasClass("d-none") ) {
            $(".tbr_floating_cta").removeClass("tbr_active_cart")
        } else {
            $(".tbr_floating_cta").addClass("tbr_active_cart")
        }

        /* ======================================
        * Appended box list
        ====================================== */
        if ($(window).width() < 1200) {
            $('.tbr_box_list').appendTo('.tbr_member_aside');
        }
    </script>
@endsection