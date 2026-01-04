@extends('visitor.layouts.app')
@section('title', 'Order Step 3')
@section('content')
<div class="tbr_wizard_header">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="tbr_wizard_label">
                    <li class="tbr_active"><span>1</span></li>
                    <li class="tbr_active"><span>2</span></li>
                    <li class="tbr_active"><span>3</span></li>
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
                        <span class="tbr_text-primary">Data diri pasien dan informasi pesanan</span>
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
                                        <em>{{ Str::limit(session('step2dataSelf')->name, 14, '...') }}</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="tbr_block_list">
                            <div class="row no-gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="tbr_text-secondary">Tanggal lahir</div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="text-left text-md-right">
                                        <em>{{ formatDate(session('step2dataSelf')->date_of_birth, 'd F Y') }}</em>
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
                                        <em>{{ session('step2dataSelf')->gender }}</em>
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
                                        <em>{{ session('step2dataSelf')->job }}</em>
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
                                        <em>62 {{ session('step2dataSelf')->phone_number }}</em>
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
                                        <em>62 {{ session('step2dataSelf')->whatsapp_number }}</em>
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
                                        <em>{{ session('step2dataSelf')->email }}</em>
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
                                    {{ session('step2dataSelf')->address }}, {{ session('step2dataSelf')->village }}, Kecamatan {{ getDistrictName(session('step2dataSelf')->district_id) }},
                                    {{ getRegencyName(session('step2dataSelf')->regency_id) }}, Provinsi {{ getProvinceName(session('step2dataSelf')->province_id) }}
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
                                    {{ session('step2dataSelf')->symptoms }}
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
                @if (!session('therapistSelfOrder')->isEmpty())
                {{-- Terapist --}}
                <div class="tbr_therapists mt-4 pt-0">
                    @foreach ($services as $service)
                    <div class="tbr_therapist">
                        <div class="tbr_therapist_img">
                            @if ($therapist->photo_path)
                            <img src="{{ Storage::url($therapist->photo_path) }}" alt="{{ $therapist->name }}">
                            @else
                            <img class="w-100" src="{{ asset('/assets/images/sample_therapist_01.png') }}" alt="{{ $therapist->name }}">
                            @endif
                        </div>
                        <div class="tbr_therapist_detail">
                            <div class="tbr_therapist_name">
                                <span>{{ $therapist->name }}</span>
                                <span>STR. {{ Str::limit($therapist->str_number, 18, '...') }}</span>
                            </div>
                            <div class="tbr_therapist_skill">
                                @foreach ($therapist->services->take(4) as $subService)
                                {{ $subService->title }}
                                {{ $loop->last ? ($therapist->services->count() > 4 ? '...' : '') : ', ' }}
                                @endforeach
                            </div>
                            <div class="tbr_therapist_meta">
                                <span>
                                    <img src="{{ asset('/assets/svg/icons/icon_pin_map.svg') }}" alt="Location">&nbsp;
                                    {{ $therapist->district->name }}
                                </span>
                                <span>
                                    <span>{{ formatPrice(getServiceDisplayPrice($therapist->id, $service->id)) }}</span>
                                    ({{ $service->title }})
                                </span>
                            </div>
                        </div>
                        <a
                            href="javascript:void(0)"
                            class="tbr_btn_remove"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="😢 Anda ingin menghapus jasa terapis ini beserta layanannya?"
                            data-html="true"
                            data-service="{{ $service->id }}">
                            <img src="{{ asset('/assets/svg/icons/icon_cross.svg') }}" alt="Delete">
                        </a>
                    </div>
                    @endforeach
                </div>

                {{-- Amount --}}
                <div class="text-center mt-4 pt-2">
                    <p class="mb-1">Total yang harus dibayar adalah</p>
                    <div class="tbr_amount">{{ formatPrice($services->sum(function($service) use ($therapist) { return getServiceDisplayPrice($therapist->id, $service->id); })) }}</div>
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
                            @if (session('step2dataSelf')->payment_method === "Cash")
                            <span class="tbr_weight-semi-bold tbr_text-secondary">Cash &nbsp;</span>
                            <span><em>(Bayar langsung ke terapis tanpa melalui bank transfer)</em></span>
                            @else
                            <span class="tbr_weight-semi-bold tbr_text-secondary">Transfer &nbsp;</span>
                            <span><em>(Pembayaran ke haloterapi melalui bank transfer)</em></span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                {{--
                    ===========================================
                        PERHATIKAN GAES !!! : JIKA KOSONG
                        Ketika semua layanan dihapus, wizard footer nav menjadi hilang
                    ===========================================
                    --}}
                @if ($services->isEmpty())
                <div class="row justify-content-center mt-4">
                    <div class="col-xl-9 col-lg-9 col-md-10 col-12">
                        <div class="alert alert-danger" role="alert">
                            Anda telah mehapus semua layanan yang dipesan beserta terapisnya😢
                        </div>
                        {{-- Ketika diklik pada button ini, data order sebelumnya yang ada di cookies browser HUILANG !!! --}}
                        <div class="text-center mt-4 mb-4 pt-1 pb-2">
                            <a href="{{ route('therapist.order.step-1') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary btr_wizard_order_reset">
                                Order Lagi
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@if (!session('therapistSelfOrder')->isEmpty())
<div class="tbr_wizard_footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tbr_wizard_nav">
                    <a href="{{ route('therapist.order.step-2') }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
                        <i class="icons icon-arrow-left"></i> Sebelumnya
                    </a>
                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_wizard_next">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('blockfoot')
<script src="{{ asset('assets/js/visitor/therapist/step3-delete-data.js') }}"></script>
<script src="{{ asset('assets/js/visitor/therapist/step3-submit-data.js') }}"></script>
@endsection