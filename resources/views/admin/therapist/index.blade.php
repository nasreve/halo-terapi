@extends('admin.layouts.app')
@section('title', 'Terapis')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2/css/select2.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('porto/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
@endsection
@section('content')
	<header class="page-header">
		<h2>Terapis</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<span>Terapis</span>
				</li>
			</ol>
		</div>
	</header>
	{{--
	<div class="row">
		<div class="col">
			<div class="card mb-4">
				<div class="card-body px-3 py-3">
					<div class="d-flex justify-content-start align-items-center tbr_card_alert">
						<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
							<g id="info">
								<rect id="Rectangle_1839" data-name="Rectangle 1839" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#ffae25" opacity="0"/>
								<path id="Path_718" data-name="Path 718" d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" fill="#ffae25"/>
								<circle id="Ellipse_205" data-name="Ellipse 205" cx="1" cy="1" r="1" transform="translate(11 7)" fill="#ffae25"/>
								<path id="Path_719" data-name="Path 719" d="M12,10a1,1,0,0,0-1,1v5a1,1,0,0,0,2,0V11A1,1,0,0,0,12,10Z" fill="#ffae25"/>
							</g>
						</svg>
						<span class="ml-3">Demo detail terapis pakai url ini gaes...!!! <a href="{{ url('') }}/admin/therapist/1">http://localhost:8000/admin/therapist/1</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	--}}
	<div class="row justify-content-center pt-0">
		<div class="col">
			<div class="card">
				<div class="card-body p-4">
					<table class="table tbr_table table-hover mb-0">
						<thead>
							<tr>
								<th style="width: 7%">No</th>
								<th style="width: 12%">Nama</th>
								<th>Alamat</th>
								<th style="width: 17%">Sumber Informasi</th>
								<th style="width: 7%">WA</th>
								<th style="width: 15%">S. Penerimaan</th>
								<th style="width: 10%">S. Akun</th>
								<th>Actions</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('admin.include.modal-delete')
@endsection
@section('blockfoot')
	<script src="{{ asset('porto/vendor/select2/js/select2.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('porto/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/js/admin/therapist-datatable.js') }}"></script>
	<script src="{{ asset('assets/js/default-delete.js') }}"></script>
	<script>
		let url = "{{ route('therapist.list') }}";
		let orderFalse = [0, 4, 7];
		let therapistDatatable;
		$(function() {
			therapistDatatable = initDatatables(url, orderFalse);
		});

		$('.tbr_therapist').addClass('nav-active');
	</script>
@endsection