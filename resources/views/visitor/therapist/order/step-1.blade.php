@extends('visitor.layouts.app')
@section('title', 'Tambah Order Baru')
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
                    <div class="tbr_page_title mb-4 pb-2">
                        <h4 class="tbr_weight-bold tbr_text-primary mb-1">Buat Pesanan Baru</h4>
                        <p class="mb-0">Silakan pilih layanan yang sesuai dengan penyakit atau keluhan dari pasien.</p>
                    </div>
                    <div class="tbr_services_column" id="service">
                        <div class="row">
                            @php
                            $paginatedData = paginateCollection($therapist->services->where('pivot.status', 'Diterima'), 6, $page)
                            @endphp
                            @forelse ($paginatedData as $service)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-6 tbr_column">
                                <div class="tbr_service_card">
                                    <input type="checkbox" id="service-{{ $service->id }}" name="service" value="{{ $service->id }}" class="d-none" {{ checkedOrderSelfTherapist($service->id) }}>
                                    <label for="service-{{ $service->id }}" class="radio" anim="ripple"></label>
                                    <div class="tbr_sc_check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24.3" height="18.245" viewBox="0 0 24.3 18.245">
                                            <path id="Path_761" data-name="Path 761" d="M12.878,24.2a1.515,1.515,0,0,1-1.106-.485L4.41,15.884a1.516,1.516,0,1,1,2.212-2.075l6.241,6.65L25.6,6.523a1.515,1.515,0,1,1,2.242,2.03L14,23.7a1.515,1.515,0,0,1-1.106.5Z" transform="translate(-3.999 -5.956)" fill="#ddd" />
                                        </svg>
                                    </div>
                                    <h4>{{ $service->title }}</h4>
                                    <p>{{ Str::limit($service->description, 65, $end='...') }}</p>
                                    <a href="" class="tbr_text-success d-block mb-2" data-toggle="modal" data-target="#modal-service-{{ $service->id }}"><em>Selengkapnya</em></a>
                                    <div class="mb-4 tbr_service_card_price">{{ formatPrice(getServiceDisplayPrice($therapist->id, $service->id)) }}</div>
                                    <div class="tbr_btn_group">
                                        <button type="button" class="btn tbr_btn tbr_btn-success tbr_btn_order">Pesan</button>
                                        <button type="button" class="btn tbr_btn tbr_btn-light-danger tbr_btn_cancel">Batalkan</button>
                                    </div>
                                </div>
                                @include('visitor.partials.modal-service-therapist-self')
                            </div>
                            @empty
                            <div class="col">
                                <div class="alert alert-warning d-flex align-items-center justify-content-between mb-4" role="alert">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <img class="mr-3" src="{{ asset('assets/svg/icons/icon_exclamation_small.svg') }}" alt="Success">
                                        <span>
                                            Saat ini belum ada layanan milik Anda yang disetujui admin.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        @if ($paginatedData->lastPage() > 1)
                        <nav aria-label="Page navigation" class="mt-4 mb-0 pt-2">
                            <ul class="pagination tbr_pagination m-auto justify-content-center">
                                <li class="page-item {{ ($paginatedData->currentPage() == 1) ? ' tbr_disabled' : '' }}">
                                    <a class="page-link" href="{{ route('therapist.order.step-1', ['page' => $paginatedData->currentPage()-1 ]) }}">
                                        <img src="{{ asset('/assets/svg/icons/icon_paginate_prev.svg') }}" alt="Previous">
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $paginatedData->lastPage(); $i++)
                                    <li class="page-item {{ ($paginatedData->currentPage() == $i) ? ' tbr_active' : '' }}">
                                        <a class="page-link" href="{{ route('therapist.order.step-1', ['page' => $i ]) }}">{{ $i }}</a>
                                    </li>
                                    @endfor
                                    <li class="page-item {{ ($paginatedData->currentPage() == $paginatedData->lastPage()) ? ' tbr_disabled' : '' }}">
                                        <a class="page-link" href="{{ route('therapist.order.step-1', ['page' => $paginatedData->currentPage()+1 ]) }}">
                                            <img src="{{ asset('/assets/svg/icons/icon_paginate_next.svg') }}" alt="Next">
                                        </a>
                                    </li>
                            </ul>
                            <nav aria-label="Page navigation" class="mt-4 mb-0 pt-2">
                                @endif
                    </div>
                </div>
            </div>
        </div>
        @include('visitor.includes.self-therapist-cart')
        @endsection
        @section('blockfoot')
        <script src="{{ asset('assets/js/visitor/therapist/order.js') }}"></script>
        <script src="{{ asset('assets/js/visitor/profile-order/pagination.js') }}"></script>
        <script>
            /* ======================================
        * Fix positioning floting whatsapp
        ====================================== */
            if ($(".tbr_cart").hasClass("d-none")) {
                $(".tbr_floating_cta").removeClass("tbr_active_cart")
            } else {
                $(".tbr_floating_cta").addClass("tbr_active_cart")
            }
        </script>
        @endsection