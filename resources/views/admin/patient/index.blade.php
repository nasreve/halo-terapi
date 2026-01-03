@extends('admin.layouts.app')
@section('title', 'Pasien')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
@endsection
@section('content')
	<header class="page-header">
		<h2>Pasien</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<span>Pasien</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-body p-4">
					<table class="table tbr_table table-hover mb-0">
						<thead>
							<tr>
								<th style="width: 7%">No</th>
								<th style="width: 15%">Nama</th>
								<th style="width: 10%">Umur</th>
								<th style="width: 15%">Pekerjaan</th>
								<th style="width: 13%">Kota</th>
								<th style="width: 20%">Sumber Informasi</th>
								<th style="width: 7%">WA</th>
								<th style="width: 10%">Status</th>
								<th style="width: 15%" class="tbr_action">Actions</th>
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
	<script src="{{ asset('assets/js/admin/patient-datatable.js') }}"></script>
	<script src="{{ asset('assets/js/default-delete.js') }}"></script>
	<script>
		$('.tbr_patient').addClass('nav-expanded nav-active');
	</script>
	<script>
		let url = "{{ route('patient.list') }}";
		let orderFalse = [0, 6, 8];
		let orderDatatable;
		$(function() {
			orderDatatable = initDatatables(url, orderFalse);
		});
	</script>
@endsection