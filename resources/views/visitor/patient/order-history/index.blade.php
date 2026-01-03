@extends('visitor.layouts.app')
@section('title', 'Riwayat Pesanan')
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
			@include('visitor.layouts.patient-aside')
			<div class="tbr_member_content_body">
				<div class="tbr_page_title mb-4 pb-2">
					<h4 class="tbr_weight-bold tbr_text-primary mb-1">Riwayat Pesanan</h4>
					<p class="mb-0">Kami tampilkan semua data pemesanan layanan terapi dari Anda.</p>
				</div>
				<table class="table tbr_table tbr_table_order">
					<thead>
						<tr>
							<th style="width: 6%">No</th>
							<th style="width: 13%">ID Pesanan</th>
							<th>Layanan</th>
							<th style="width: 13%">Terapis</th>
							<th style="width: 12%">Biaya</th>
							<th style="width: 10%">
								<img src="{{ asset('/assets/svg/icons/icon_datatable_cc.svg') }}" alt="Payment Method">
							</th>
							<th style="width: 15%">Pembayaran</th>
							<th style="width: 18%">Actions</th>
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
	<script src="{{ asset('assets/js/visitor/default-datatable.js') }}"></script>
	<script>
		const url = "{{ route('patient.order.history.list') }}";
		const orderFalse = [7];

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