@extends('visitor.layouts.app')
@section('title', 'Detail Pesanan')
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
			@include('visitor.layouts.patient-aside')
			<div class="tbr_member_content_body">
                @if (session('success'))
                    {{-- Alert di bawah untuk REPEAT ORDER yang berhasil --}}
                    <div class="alert alert-primary d-flex align-items-center justify-content-between mb-4" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_check_circle_success.svg') }}" alt="Success">
                            <span>Anda berhasil melakukan pemesanan ulang. Di bawah adalah detail pesanan Anda.</span>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g id="Layer_2" data-name="Layer 2" opacity="0.5">
                                    <g id="close">
                                        <rect id="Rectangle_1493" data-name="Rectangle 1493" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#fff" opacity="0"/>
                                        <path id="Path_553" data-name="Path 553" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#fff"/>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="tbr_page_title mb-2">
                            <h4 class="tbr_weight-bold tbr_text-primary mb-2">Detail Pesanan</h4>
                            <span class="mr-2">{{ $order->order_id }}</span>
                            @if ($order->payment_status === "Sudah Dibayar")
                                <span class="tbr_label tbr_label-light-primary">Sudah Dibayar</span>
                            @else
                                <span class="tbr_label tbr_label-light-danger">Belum Dibayar</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-left text-md-right">
                            <p class="mb-0">Dibuat pada</p>
                            <p class="mb-0"><em>{{ formatDate($order->created_at, 'd F Y \j\a\m H.i') }}</em></p>
                        </div>
                    </div>
                </div>

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
                                        <em>{{ \Illuminate\Support\Str::limit($order->buyer_name, 22, ' ...') }}</em>
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
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
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
                                    {!! $order->buyer_symptoms !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Terapist : ini bisa 1 atau lebih --}}
                <div class="tbr_therapists mt-4 pt-0">
                    {{-- Yang di loop ini --}}
                    @foreach ($order->orderItems as $orderItem)
                        <div class="tbr_therapist">
                            <div class="tbr_therapist_img">
                                @if ($order->therapist->photo_path)
                                    <img src="{{ Storage::url($order->therapist->photo_path) }}" alt="{{ $order->therapist->name }}">
                                @else
                                    <img class="w-100" src="{{ asset('/assets/images/sample_therapist_01.png') }}" alt="{{ $order->therapist->name }}">
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
                                        <span>{{ formatPrice($orderItem->rate) }}</span>
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
                    <div class="tbr_amount">{{ formatPrice($order->transaction_amount) }}</div>
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
                            <div class="tbr_info_box_desc">
                                @if ($order->buyer_payment_method === "Cash")
                                    <span class="tbr_weight-semi-bold tbr_text-secondary">Cash &nbsp;</span>
                                    <span><em>(Bayar langsung ke terapis tanpa melalui bank transfer)</em></span>
                                @elseif ($order->buyer_payment_method === "Transfer")
                                    <span class="tbr_weight-semi-bold tbr_text-secondary">Transfer &nbsp;</span>
                                    <span><em>(Pembayaran ke haloterapi melalui bank transfer)</em></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if ($order->buyer_payment_method === "Transfer")
                    <div class="row justify-content-center mt-4 pt-0">
                        <div class="col-xl-7 col-lg-6 col-md-7 col-12">
                            <div class="tbr_dual_box">
                                <div class="tbr_box_left">
                                    @if ($setting->logo_path)
                                        <div class="tbr_img" style="background-image: url('{{ Storage::url($setting->logo_path) }}')"></div>
                                    @else
                                        <div class="tbr_img" style="background-image: url('{{ asset('/assets/svg/etc/BCA.svg') }}')"></div>
                                    @endif
                                </div>
                                <div class="tbr_box_right">
                                    <p class="mb-0">{{ $order->buyer_account_number }}</p>
                                    <p class="mb-0">a.n. {{ $order->buyer_account }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-center mt-4 pt-0">
                    <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light mx-1 mx-md-2 mt-2">
                        Kembali
                    </a>
                    <a href="{{ route('order.invoice.print', $order->id) }}" anim="ripple" class="btn tbr_btn tbr_btn-primary mx-1 mx-md-2 mt-2" target="_blank">
                        <img class="mr-1" src="{{ asset('/assets/svg/icons/icon_invoice_print.svg') }}" alt="Print">
                        Print
                    </a>
                    <a href="{{ route('order.invoice.download', $order->id) }}" anim="ripple" class="btn tbr_btn tbr_btn-danger mx-1 mx-md-2 mt-2">
                        <img class="mr-1" src="{{ asset('/assets/svg/icons/icon_invoice_download.svg') }}" alt="Download">
                        Download
                    </a>
                </div>
			</div>
		</div>
	</div>
@endsection
@section('blockfoot')
	<script>
		$('.tbr_member_nav_history_order').addClass('tbr_nav_active');
	</script>
@endsection