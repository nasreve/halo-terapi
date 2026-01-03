@extends('admin.layouts.app')
@section('title', 'Pesanan')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
@endsection
@section('content')
	<header class="page-header">
		<h2>Pesanan</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<span>Pesanan</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-1">
								<div class="input-daterange input-group tbr_fix_ig" data-plugin-datepicker>
									<span class="input-group-prepend">
										<img src="{{ asset('assets/svg/icons/icon_filter_calendar.svg') }}" alt="Calendar">
									</span>
									<input type="text" class="form-control" id="dateStart" name="start" placeholder="00-00-0000" autocomplete="off">
									<span class="input-group-text border-left-0 border-right-0 rounded-0 d-none d-md-block">Sampai</span>
									<span class="input-group-text border-left-0 border-right-0 rounded-0 d-block d-md-none">to</span>
									<input type="text" class="form-control" id="dateEnd" name="end" placeholder="00-00-0000" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
							<div class="form-group mb-1">
								<select
									class="form-control"
									id="therapistFilter"
									name="therapist"
									placeholder=""
									tabindex=""
									data-plugin-selectTwo
								>
									<option value="" title="All">Semua Terapis</option>
									@foreach ($therapists as $therapist)
										<option value="{{ $therapist->name }}">{{ $therapist->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-7">
							<div class="form-group mb-1">
								<select
									class="form-control"
									id="referralFilter"
									name="referral"
									placeholder=""
									tabindex=""
									data-plugin-selectTwo
								>
									<option value="" title="All">Semua Referrar</option>
									@foreach ($referrers as $referrer)
										<option value="{{ $referrer }}">{{ $referrer }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-xl-4 col-lg-2 col-md-6 col-sm-6 col-5">
							<div class="d-flex justify-content-end mb-1">
								<button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-success btn-filter">
									<img class="mr-2" src="{{ asset('/assets/svg/icon_filter.svg') }}" alt="Filter">
									Filter
								</button>
							</div>
						</div>
					</div>
					<hr class="solid mt-3 mb-3">
					<div class="pt-1">
						<table class="table tbr_table tbr_table_order table-hover mb-0">
							<thead>
								<tr>
									<th width="7%">No</th>
									<th width="10%">Order ID</th>
									<th width="12%">Tgl.</th>
									<th width="10%">Layanan</th>
									<th width="12%">Terapis</th>
									<th width="10%">Pasien</th>
									<th width="10%">Referrer</th>
									<th width="9%">Metode</th>
									<th width="11%">Pembayaran</th>
									<th width="10%">Pelaksanaan</th>
									<th width="9%" class="tbr_action">Actions</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('admin.include.modal-delete')
@endsection
@section('sticky-toolbar')
	<ul class="tbr_sticky_toolbar">
		<li class="tbr_sticky_toolbar_item tbr_reset">
			<a href="#" onclick="reset(event)" class="tbr_sticky_toolbar-success">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
					<g id="Layer_2" data-name="Layer 2" opacity="0.5">
						<g id="refresh">
							<rect id="Rectangle_1152" data-name="Rectangle 1152" width="24" height="24" fill="#8a949b" opacity="0"/>
							<path id="Path_304" data-name="Path 304" d="M3.742,13.43a1,1,0,0,1,1.252.65A7.151,7.151,0,0,0,11.876,19a7.106,7.106,0,0,0,7.192-7,7.106,7.106,0,0,0-7.192-7A7.279,7.279,0,0,0,7.218,6.67l2.174-.36a1,1,0,1,1,.321,1.98l-4.247.7h-.17a1,1,0,0,1-.341-.06.331.331,0,0,1-.1-.06.782.782,0,0,1-.2-.11l-.09-.11c0-.05-.09-.09-.13-.15s0-.1-.05-.14a1.339,1.339,0,0,1-.07-.18l-.751-4a1.019,1.019,0,0,1,2-.38l.27,1.45A9.234,9.234,0,0,1,11.876,3a9.108,9.108,0,0,1,9.195,9,9.108,9.108,0,0,1-9.195,9,9.134,9.134,0,0,1-8.834-6.32,1,1,0,0,1,.7-1.25Z" transform="translate(-0.036)" fill="#8a949b"/>
						</g>
					</g>
				</svg>
			</a>
		</li>
		<li class="tbr_sticky_toolbar_item">
			<a href="{{ url()->previous() }}" class="tbr_sticky_toolbar-orange">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
					<g id="Layer_2" data-name="Layer 2" opacity="0.5">
						<g id="arrow-back">
							<rect id="Rectangle_1737" data-name="Rectangle 1737" width="24" height="24" transform="translate(24) rotate(90)" fill="#8a949b" opacity="0"/>
							<path id="Path_690" data-name="Path 690" d="M19,11H7.14l3.63-4.36A1,1,0,0,0,9.23,5.36l-5,6a1.19,1.19,0,0,0-.09.15.127.127,0,0,1-.07.13.961.961,0,0,0,0,.72.127.127,0,0,0,.07.13,1.19,1.19,0,0,0,.09.15l5,6a1,1,0,1,0,1.54-1.28L7.14,13H19a1,1,0,0,0,0-2Z" fill="#8a949b"/>
						</g>
					</g>
				</svg>
			</a>
		</li>
	</ul>
@endsection
@section('blockfoot')
	<script src="{{ asset('porto/vendor/luxon/luxon.js') }}"></script>
	<script src="{{ asset('porto/vendor/select2/js/select2.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
	<script src="{{ asset('assets/js/admin/order-datatable.js') }}"></script>
	<script src="{{ asset('assets/js/admin/order-filter.js') }}"></script>
	<script src="{{ asset('assets/js/default-delete.js') }}"></script>
	<script>
		let url = "{{ route('order.list') }}";
		let orderFalse = [0, 10];
		let orderDatatable;
		$(function() {
			orderDatatable = initDatatables(url, orderFalse, initTooltip);
		});

		function initTooltip() {
			$(function () {
				$('[data-toggle="tooltip"]').tooltip({
					trigger : 'hover'
				});
			});
		}

		$('html').addClass('sidebar-left-collapsed').removeClass('sidebar-left-opened');
		$('.tbr_order').addClass('nav-active');
	</script>
@endsection