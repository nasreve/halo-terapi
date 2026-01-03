@extends('visitor.layouts.app')
@section('title', 'Data Pesanan')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
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
		<div class="tbr_member_area tbr_sm_aside">
			@include('visitor.layouts.therapist-aside')
			<div class="tbr_member_content_body">
				@if (session('register_status') === 'success')
                    <div class="alert alert-primary d-flex align-items-center justify-content-between mb-4" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_check_circle_success.svg') }}" alt="Success">
                            <span>
								Selamat {{ $therapist->name }}, Anda telah berhasil menyelesaikan proses pendaftaran
								di {{ config('app.name') }}. Di sini adalah Dashboard untuk mengelola pesanan Anda.
							</span>
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

				@if (!session()->has('register_status'))
					@if ($therapist->status === "Menunggu")
						<div class="alert alert-warning d-flex align-items-center justify-content-between mb-4" role="alert">
							<div class="d-flex align-items-center justify-content-between">
								<img class="mr-3" src="{{ asset('/assets/svg/icons/icon_exclamation_small.svg') }}" alt="Success">
								<span>
									Pendaftaran Anda saat ini sedang menunggu Persetujuan Admin. Anda belum dapat melakukan pelayanan kepada pasien, jika ada pertanyaan silakan menghubungi admin.
								</span>
							</div>
						</div>
					@endif

					@if ($therapist->status === "Ditolak")
						<div class="alert alert-danger d-flex align-items-center justify-content-between mb-4" role="alert">
							<div class="d-flex align-items-center justify-content-between">
								<img class="mr-3" src="{{ asset('/assets/svg/icons/icon_exclamation_danger.svg') }}" alt="Success">
								<span>
									Mohon maaf Anda TIDAK DITERIMA sebagai terapis kami. Dikarenakan ada beberapa kriteria yang tidak memenuhi persyaratan.
									<br>
									Untuk lebih lengkapnya silakan menghubungi admin.
								</span>
							</div>
						</div>
					@endif
				@endif

                <div class="row align-items-center mb-4 pb-0 pb-md-2">
                    <div class="col-md-8">
                        <div class="tbr_page_title mb-3 mb-md-0">
                            <h4 class="tbr_weight-bold tbr_text-primary mb-1">Data Pesanan</h4>
                            <p class="mb-0">Data pemesanan layanan terapi dari pasien.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-center justify-content-md-end">
							@if ($therapist->status === "Disetujui")
								<a href="{{ route('therapist.order.step-1') }}" anim="ripple" class="btn tbr_btn tbr_btn-success">Buat pesanan baru</a>
							@else
								<a href="#" anim="ripple" class="btn tbr_btn tbr_btn-success tbr_disabled">Buat pesanan baru</a>
							@endif
                        </div>
                    </div>
                </div>
				<table class="table tbr_table tbr_table_order">
					<thead>
						<tr>
							<th style="width: 5%">No</th>
							<th style="width: 13%">ID Pesanan</th>
							<th style="width: 13%">Layanan</th>
							<th style="width: 13%">Pasien</th>
							<th style="width: 15%">Pembayaran</th>
							<th style="width: 14%">Pelaksanaan</th>
							<th style="width: 8%">Kontak</th>
							<th style="width: 19%">Actions</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@section('blockfoot')
	<script src="{{ asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/js/visitor/datatable-with-select2.js') }}"></script>
	<script src="{{ asset('assets/js/visitor/therapist/order-datatable.js') }}"></script>
	<script>
		const url = "{{ route('therapist.order.history.list') }}";
		const orderFalse = [6, 7];

		initDatatables(url, orderFalse, initTooltip);

		function initTooltip() {
			$(function () {
				$('[data-toggle="tooltip"]').tooltip({
					trigger : 'hover'
				});
			});
		}

		$('.tbr_member_nav_history_order').addClass('tbr_nav_active');
	</script>
@endsection