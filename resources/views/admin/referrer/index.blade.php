@extends('admin.layouts.app')
@section('title', 'Referrer')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
@endsection
@section('content')
	<header class="page-header">
		<h2>Referrer</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<span>Referrer</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-body p-4">
					<table class="table tbr_table tbr_table_referrer table-hover mb-0">
						<thead>
							<tr>
								<th width="7%">No</th>
								<th width="10%">K.Unik</th>
								<th width="15%">Nama</th>
								<th width="20%">Komunitas Bisnis</th>
								<th width="10%">Kota</th>
								<th width="15%">Sumber</th>
								<th width="5%">WA</th>
								<th width="10%">S. Ref</th>
								<th width="8%" class="tbr_action">Actions</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			@include('admin.include.modal-delete')
		</div>
	</div>
@endsection
@section('blockfoot')
	<script src="{{ asset('porto/vendor/luxon/luxon.js') }}"></script>
	<script src="{{ asset('porto/vendor/select2/js/select2.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
	<script src="{{ asset('assets/js/admin/referrer-datatable.js') }}"></script>
	<script src="{{ asset('assets/js/default-delete.js') }}"></script>
	<script>
		$('.tbr_referrer').addClass('nav-expanded nav-active');
	</script>
	<script>
		let url = "{{ route('referrer.list') }}";
		let orderFalse = [0, 6, 8];
		let orderDatatable;
		$(function() {
			orderDatatable = initDatatables(url, orderFalse);
		});
	</script>
@endsection