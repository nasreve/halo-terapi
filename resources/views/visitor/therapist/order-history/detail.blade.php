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
			@include('visitor.layouts.therapist-aside')
			<div class="tbr_member_content_body">
                {{-- Alert di bawah untuk REPEAT ORDER yang berhasil --}}
                @if (session('repeat_order_status') === 'success')
                    <div class="alert alert-primary d-flex align-items-center justify-content-between mb-4" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_check_circle_success.svg') }}" alt="Success">
                            <span>Anda berhasil melakukan pemesanan ulang. Di bawah adalah detail pesanan pasien.</span>
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

                {{-- Alert di bawah untuk NEW ORDER yang berhasil --}}
                @if (session('new_order_status') === 'success')
                    <div class="alert alert-primary d-flex align-items-center justify-content-between mb-4" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_check_circle_success.svg') }}" alt="Success">
                            <span>Anda berhasil membuat pesanan dan menambahkan pasien baru. Secara otomatis, sistem akan mengirimkan data akun beserta detail pesanan ke pasien.</span>
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
                                <span class="tbr_label tbr_label-light-primary mr-2">Sudah Dibayar</span>
                            @elseif ($order->payment_status === "Belum Dibayar")
                                <span class="tbr_label tbr_label-light-danger mr-2">Belum Dibayar</span>
                            @endif

                            @if ($order->order_status === "Menunggu")
                                <span class="tbr_label tbr_label-light-light mr-2">Menunggu</span>
                            @elseif ($order->order_status === "Terjadwal")
                                <span class="tbr_label tbr_label-light-warning mr-2">Terjadwal</span>
                            @elseif ($order->order_status === "Selesai")
                                <span class="tbr_label tbr_label-light-primary mr-2">Selesai</span>
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
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="tbr_block_list">
                            <div class="row no-gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="tbr_text-secondary">Kontak</div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                    <div class="text-left text-md-right">
                                        <a
                                            href="tel:+62{{ $order->buyer_phone }}"
                                            class="mr-2 pr-1"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Hubungi {{ $order->buyer_name }} melalui telepon"
                                            target="_blank"
                                        >
                                            <img src="{{ asset('/assets/svg/icons/icon_v_phone.svg') }}" alt="Phone">
                                        </a>
                                        <a
                                            href="https://api.whatsapp.com/send/?phone=62{{ $order->buyer_whatsapp }}"
                                            class="mr-0"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Hubungi {{ $order->buyer_name }} melalui chatting WhatsApp"
                                            target="_blank"
                                        >
                                            <img src="{{ asset('/assets/svg/icons/icon_v_whatsapp.svg') }}" alt="WhatsApp">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="tbr_therapists mt-3 pt-0">
                    <div class="tbr_table_rounded table-responsive">
                        <table class="table tbr_table_therapist_sevices">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Terapis</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <td>
                                            <span class="tbr_weight-semi-bold tbr_text-primary">{{ $orderItem->service }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $orderItem->order->therapist->name }}</span>
                                            <span><em>(Anda)</em></span>
                                        </td>
                                        <td>
                                            <span class="tbr_weight-bold">{{ formatPrice($orderItem->rate) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total yang harus dibayar pasien</th>
                                    <th>
                                        <span class="tbr_weight-bold tbr_text-danger">{{ formatPrice($order->transaction_amount) }}</span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                @if ($order->buyer_payment_method === "Cash")
                    <div class="text-center mt-4 pt-2">
                        <div class="alert alert-warning text-center tbr_weight-semi-bold mb-0 d-inline-block" role="alert">
                            Pastikan nominal yang dibayarkan oleh pasien harus sama dengan nominal di atas.
                        </div>
                    </div>
                @endif

                @if ($order->buyer_payment_method === "Transfer")
                    <div class="text-center mt-4 pt-2">
                        <div class="alert alert-warning text-center tbr_weight-semi-bold mb-0 d-inline-block" role="alert">
                            Karena pasien melakukan pembayaran transfer, Anda cukup mengubah status pelaksanaannya saja.
                        </div>
                    </div>
                @endif

                <div class="row mt-3 pt-0">
                    <div class="col-12" id="ajax-wrapper">
                        <div class="text-center">
                            @if ($order->buyer_payment_method === "Cash")
                                <form action="{{ route('therapist.order.update', $order->id) }}" method="post" class="main_form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="tbr_status_box">
                                        <div class="form-group mb-0">
                                            <div class="tbr_radio_group">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="unpaid" name="payment_status" class="custom-control-input" value="Belum Dibayar" {{ $order->payment_status === "Belum Dibayar" ? "checked" : "" }} onclick="visibilty1();">
                                                    <label class="custom-control-label" for="unpaid">Belum Dibayar</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mr-0">
                                                    <input type="radio" id="paid" name="payment_status" class="custom-control-input" value="Sudah Dibayar" {{ $order->payment_status === "Sudah Dibayar" ? "checked" : "" }} onclick="visibilty2();">
                                                    <label class="custom-control-label" for="paid">Sudah Dibayar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbr_status_box">
                                        <div class="form-group mb-0">
                                            <div class="tbr_radio_group">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="waiting" name="order_status" class="custom-control-input" value="Menunggu" {{ $order->order_status === "Menunggu" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="waiting">Menunggu</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="schedule" name="order_status" class="custom-control-input" value="Terjadwal" {{ $order->order_status === "Terjadwal" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="schedule">Terjadwal</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mr-0">
                                                    <input type="radio" id="done" name="order_status" class="custom-control-input" value="Selesai"  {{ $order->order_status === "Selesai" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="done">Selesai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form action="{{ route('therapist.order.update', $order->id) }}" method="post" class="secondary_form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="paid_amount">
                                    <span class="invalid-feedback mt-4 tbr_block_invalid_feedback" role="alert"></span>
                                    <div class="tbr_payment_wrap {{ $order->payment_status === "Belum Dibayar" ? "tbr_payment_disabled" : "" }}" id="tbr_payment_wrap">
                                        <div class="tbr_payment_group mt-4 pt-2">
                                            <div class="form-group mb-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend tbr_bg-light-grey">Biaya</div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="transaction_amount"
                                                        name="transaction_amount"
                                                        value="{{ formatNumberTwoComas($order->transaction_amount) }}"
                                                        placeholder=""
                                                        tabindex=""
                                                        disabled
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group mb-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend tbr_bg-light-grey">Dibayar</div>
                                                    <div class="input-group-prepend tbr_bg-light-grey rounded-0">Rp</div>
                                                    <input
                                                        type="text"
                                                        class="form-control number-separator"
                                                        id="paid_amount"
                                                        name="paid_amount"
                                                        value="{{ formatNumberTwoComas($order->paid_amount) }}"
                                                        placeholder=""
                                                        tabindex=""
                                                        autocomplete="off"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group mb-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend tbr_bg-light-grey">Kembalian</div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="cashback_amount"
                                                        name="cashback_amount"
                                                        value="{{ formatNumberTwoComas($order->cashback_amount) }}"
                                                        placeholder=""
                                                        tabindex=""
                                                        disabled
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_btn-payment m-auto">
                                                <img class="mr-2" src="{{ asset('/assets/svg/icons/icon_check.svg') }}" alt="Save">
                                                Simpan
                                            </button>
                                        </div>
                                        @if ($order->payment_date)
                                            {{-- Jika sudah dibayar dan disubmit, maka tanggal di bawah ngambil dari database --}}
                                            <div class="text-center">
                                                <p class="mb-0 mt-4"><em>Telah dibayar pada tanggal {{ formatDate($order->payment_date, 'd F Y \j\a\m H.i') }}</em></p>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            @endif

                            @if ($order->buyer_payment_method === "Transfer")
                                <form action="{{ route('therapist.order.update', $order->id) }}" method="post" class="main_form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="tbr_status_box">
                                        <div class="form-group mb-0">
                                            <div class="tbr_radio_group">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="waiting" name="order_status" class="custom-control-input" value="Menunggu" {{ $order->order_status === "Menunggu" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="waiting">Menunggu</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="schedule" name="order_status" class="custom-control-input" value="Terjadwal" {{ $order->order_status === "Terjadwal" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="schedule">Terjadwal</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mr-0">
                                                    <input type="radio" id="done" name="order_status" class="custom-control-input" value="Selesai"  {{ $order->order_status === "Selesai" ? "checked" : "" }}>
                                                    <label class="custom-control-label" for="done">Selesai</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($order->payment_date)
                                        {{-- Jika sudah dibayar dan disubmit, maka tanggal di bawah ngambil dari database --}}
                                        <div class="text-center">
                                            <p class="mb-0 mt-4"><em>Telah dibayar pada tanggal {{ formatDate($order->payment_date, 'd F Y \j\a\m H.i') }}</em></p>
                                        </div>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-2">
                    <hr class="tbr_solid mt-0 pt-0">
                </div>
                <div class="d-flex justify-content-center mt-4 pt-0">
                    <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light mx-1 mx-md-2 mt-2">
                        Kembali
                    </a>
                    <a href="{{ route('therapist.order.invoice.print', $order->id) }}" anim="ripple" class="btn tbr_btn tbr_btn-light-primary tbr_btn_print mx-1 mx-md-2 mt-2" target="_blank">
                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" id="Group_4161" data-name="Group 4161" width="24" height="24" viewBox="0 0 24 24">
                            <rect id="Rectangle_1514" data-name="Rectangle 1514" width="24" height="24" fill="none"/>
                            <path id="Path_564" data-name="Path 564" d="M16,17v4a1,1,0,0,1-1,1H9a1,1,0,0,1-1-1V17H5a2,2,0,0,1-2-2V8A2,2,0,0,1,5,6H19a2,2,0,0,1,2,2v7a2,2,0,0,1-2,2Zm1.5-6A1.5,1.5,0,1,0,16,9.5,1.5,1.5,0,0,0,17.5,11ZM10,14v6h4V14Z" fill="#fff" fill-rule="evenodd"/>
                            <rect class="tbr_rect" id="Rectangle_1515" data-name="Rectangle 1515" width="8" height="2" rx="1" transform="translate(8 2)" fill="#fff" opacity="0.3"/>
                        </svg>
                        Print
                    </a>
                    <a href="{{ route('therapist.order.invoice.download', $order->id) }}" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn_download mx-1 mx-md-2 mt-2">
                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" id="Group_4359" data-name="Group 4359" width="24" height="24" viewBox="0 0 24 24">
                            <rect id="Rectangle_1644" data-name="Rectangle 1644" width="24" height="24" fill="none"/>
                            <path id="Path_612" data-name="Path 612" d="M2,13a1.075,1.075,0,0,1,1-1,1.075,1.075,0,0,1,1,1v5a2,2,0,0,0,2,2H18a2,2,0,0,0,2-2V13a1,1,0,0,1,2,0v5a4,4,0,0,1-4,4H6a4,4,0,0,1-4-4Z" fill="#fff" opacity="0.3"/>
                            <rect class="tbr_rect" id="Rectangle_1645" data-name="Rectangle 1645" width="2" height="14" rx="1" transform="translate(13 15) rotate(180)" fill="#fff" opacity="0.3"/>
                            <path id="Path_613" data-name="Path 613" d="M7.707,15.707a1,1,0,0,1-1.414-1.414l5-5a1,1,0,0,1,1.376-.036l5,4.5a1,1,0,0,1-1.338,1.487l-4.295-3.865Z" transform="translate(24 25) rotate(180)" fill="#fff"/>
                        </svg>
                        Download
                    </a>
                </div>
			</div>
		</div>
	</div>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/therapist/order-update.js') }}"></script>
    <script src="{{ asset('porto/vendor/autoNumeric-4.6.0/autoNumeric.min.js') }}"></script>
    <script>
        if ($(".number-separator")[0]) {
            new AutoNumeric('.number-separator', {
                allowDecimalPadding: false,
                minimumValue: 0,
                decimalCharacter: ",",
                digitGroupSeparator: ".",
                defaultValueOverride: "",
                modifyValueOnWheel: false,
            });
		}

        $("[name='order_status']").on("change", function () {
            $(".main_form").trigger("submit");
        });

        $("[name='payment_status']").on("change", function () {
            $(".main_form").trigger("submit");
        });
    </script>
    <script>
        function visibilty1() {
            document.getElementById('amount').value = '';
            document.getElementById('cashback').value = '';
            $(".tbr_payment_wrap").addClass(".tbr_payment_disabled");
        }

        function visibilty2() {
            $(".tbr_payment_wrap").removeclass(".tbr_payment_disabled");
        }
    </script>
    <script>
        function removeSaparator(num) {
            return num.replace(/\./g, '');
        };

        function addSaparator(num) {
            return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }

        $('input[type="text"]').bind('keyup keypress blur', function () {

            var firstValue  = $('#transaction_amount').val();
            var secondValue = $('#paid_amount').val();

            var x = removeSaparator(firstValue)
            var y = removeSaparator(secondValue)

            document.getElementById('cashback_amount').value = addSaparator(y - x);
        });
    </script>
	<script>
		$('.tbr_member_nav_history_order').addClass('tbr_nav_active');
	</script>
@endsection