@extends('visitor.layouts.app')
@section('title', 'Repeat Order')
@section('content')
    <div class="tbr_wizard_body tbr_repeat_order">
        <div class="container">
            <div class="row justify-content-center no-gutters">
                <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                    <div class="text-center">
                        <h4 class="tbr_weight-extra-bold tbr_section_title mb-1">
                            <span class="tbr_text-primary">Anda akan melakukan pemesanan ulang dari pesanan sebelumnya</span>
                        </h4>
                        <p>Mohon konfirmasi semua informasi di bawah.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center no-gutters">
                <div class="col-xl-8 col-lg-8 col-md-10 col-12">
                    {{-- Personal Data --}}
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Nama Pasien</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>{{ $order->buyer_name }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Umur</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>{{ $order->buyer_age }} Tahun</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Jenis Kelamin</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>{{ $order->buyer_gender }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Pekerjaan</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>{{ $order->buyer_job }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12" id="ajax-replace">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Nomor Telepon</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>62 {{ $order->buyer_phone }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Nomor WhatsApp</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>62 {{ $order->buyer_whatsapp }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_block_list">
                                <div class="row no-gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="tbr_text-secondary">Email</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                        <div class="text-left text-md-right">
                                            <em>{{ $order->buyer_email }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Location & Symptoms --}}
                    <div class="row mt-4 pt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_icon_box">
                                <img src="{{ asset('/assets/svg/icons/icon_pin_map.svg') }}" alt="Location">
                                <div class="tbr_icon_box_desc">
                                    <p class="tbr_text-secondary tbr_weight-semi-bold mb-2">Alamat Kunjungan</p>
                                    <p>
                                        {{ $order->buyer_address }}, {{ $order->buyer_sub_district }}, Kecamatan {{ $order->buyer_district }},
                                        {{ $order->buyer_regency }}, Provinsi {{ $order->buyer_province }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="tbr_icon_box">
                                <img src="{{ asset('/assets/svg/icons/icon_heartbeet.svg') }}" alt="Symptoms">
                                <div class="tbr_icon_box_desc">
                                    <p class="tbr_text-secondary tbr_weight-semi-bold mb-2">Keluhan Anda</p>
                                    <p>
                                        {{ $order->buyer_symptoms }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--
                    ===========================================
                        PERHATIKAN GAES !!! : JIKA TIDAK KOSONG
                    ===========================================
                    --}}
                    {{-- Terapist --}}
                    <div class="tbr_therapists mt-4 pt-0">
                        @foreach ($order->orderItems as $index => $orderItem)
                            <div class="tbr_therapist">
                                <div class="tbr_therapist_img">
                                    @if ($order->therapist->photo_path)
                                        <img src="{{ Storage::url($order->therapist->photo_path) }}" alt="{{ $order->therapist->name }}">
                                    @else
                                        <img src="{{ asset('/assets/images/sample_therapist_01.png') }}" alt="{{ $order->therapist->name }}">
                                    @endif
                                </div>
                                <div class="tbr_therapist_detail">
                                    <div class="tbr_therapist_name">
                                        <span>{{ $order->therapist->name }}</span>
                                        <span>STR. {{ $order->therapist->str_number }}</span>
                                    </div>
                                    <div class="tbr_therapist_skill">
                                        @forelse ($order->therapist->services->take(4) as $service)
                                            {{ $service->title }}
                                            {{ $loop->last ? ($order->therapist->services->count() > 4 ? '...' : '') : ', ' }}
                                        @empty
                                            No data available
                                        @endforelse
                                    </div>
                                    <div class="tbr_therapist_meta">
                                        <span>
                                            <img src="{{ asset('/assets/svg/icons/icon_pin_map.svg') }}" alt="Location">&nbsp;
                                            Kecamatan {{ $order->therapist->district->name }}
                                        </span>
                                        <span>
                                            <span>{{ formatPrice($rates[$index]) }}</span>
                                            ({{ $orderItem->service }})
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Amount --}}
                    <div class="text-center mt-4 pt-2">
                        <p class="mb-1">Total yang harus dibayar adalah</p>
                        <div class="tbr_amount">{{ formatPrice($transaction_amount) }}</div>
                    </div>

                    {{-- Dynamic Content --}}
                    <div class="tbr_info_box mt-4">
                        <img src="{{ asset('/assets/svg/icons/icon_exclamation.svg') }}" alt="Information">
                        <div class="tbr_info_box_desc">
                            <div class="tbr_info_box_title">Mohon untuk dibaca!</div>
                            <div class="tbr_info_box_desc">
                                {!! $setting->transport_note !!}
                            </div>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="text-center mt-4 pt-2">
                        <p class="mb-2">Jenis pembayaran yang dipilih</p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-9 col-md-10 col-12">
                            <div class="tbr_info_box py-3 justify-content-center align-items-center">
                                <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_payment_check.svg') }}" alt="Payment Method">
                                @if ($order->buyer_payment_method === "Cash")
                                    <span class="tbr_weight-semi-bold tbr_text-secondary">Cash &nbsp;</span>
                                    <span><em>(Bayar langsung ke terapis tanpa melalui bank transfer)</em></span>
                                @else
                                    <span class="tbr_weight-semi-bold tbr_text-secondary">Transfer &nbsp;</span>
                                    <span><em>(Pembayaran ke haloterapi melalui bank transfer)</em></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('order.replicate', $order->id) }}" method="POST" class="main_form" data-redirect="{{ route('patient.order.detail', $order->id) }}">
        @csrf
        <div class="tbr_wizard_footer tbr_fix_padding">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="tbr_wizard_nav">
                            <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
                                <i class="icons icon-arrow-left"></i> Sebelumnya
                            </a>
                            <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_wizard_next">
                                Konfirmasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/patient/duplicate-order.js') }}"></script>
@endsection