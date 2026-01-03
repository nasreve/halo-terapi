@extends('admin.layouts.app')
@section('title', 'Detail Pasien')
@section('content')
	<header class="page-header">
		<h2>Detail Pasien</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<a href="{{ route('patient.index') }}">
						<span>Pasien</span>
					</a>
				</li>
				<li>
					<span>Detail</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row tbr_edit_data">
		<div class="col-lg-3">
			<div class="card mt-0 mb-4">
				<div class="card-body pt-3 pr-4 pb-4 pl-4">
					<div class="tbr_block_info">
						<div>Email</div>
						<div>{{ $patient->email }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Mendaftar pada</div>
						<div>{{ formatDate($patient->created_at, 'd M Y \j\a\m H.i') }}</div>
					</div>
					<div class="mt-3">
						<button
							type="button"
							anim="ripple"
							id="delete-patient"
							class="btn tbr_btn tbr_btn-light tbr_btn-square"
							data-id="{{ $patient->id }}"
							data-url="{{ route('patient.destroy', $patient->id) }}">
							<img src="{{ asset('assets/svg/icon_trash.svg') }}" alt="Delete">
						</button>
					</div>
				</div>
			</div>
			<div class="card mt-0 mb-4">
				<div class="card-body px-4 py-3">
					<div class="tbr_block_info py-2">
						<div>Sumber Informasi</div>
						<div>{{ $patient->source }}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card mt-0 mb-4 mb-lg-0">
				<div class="card-body pb-3">
					<p class="tbr_weight-semi-bold mb-2">Data Personal Pasien</p>
					<div class="tbr_block_info">
						<div>Nama Pasien</div>
						<div>{{ $patient->name }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Umur</div>
						<div>{{ ageFormat($patient->date_of_birth) }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Jenis Kelamin</div>
						<div>{{ $patient->gender }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Pekerjaan</div>
						<div>{{ $patient->job }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Provinsi</div>
						<div>{{ getProvinceName($patient->province_id) }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Kabupaten</div>
						<div>{{ getRegencyName($patient->regency_id) }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Kecamatan</div>
						<div>{{ getDistrictName($patient->district_id) }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Kelurahan</div>
						<div>{{ $patient->village }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Detail Alamat</div>
						<div>{{ $patient->address }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Nomor Telepon</div>
						<div>62 {{ $patient->phone_number }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Nomor WhatsApp</div>
						<div>62 {{ $patient->whatsapp_number }}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card mt-0 mb-o">
				<div class="card-body padding-order p-4">
					<p class="card-label mb-2">Status</p>
					<p class="help-block">Anda dapat membanned akun dengan status ini.</p>
					<form action="{{ route('patient.update', $patient->id) }}" method="POST" class="main_form">
						@csrf
						@method('PUT')
						<div class="radio-custom radio-primary">
							<input type="radio" id="status_aktif" name="patient_status" value="0" {{ $patient->blocked == '0' ? 'checked' : '' }}>
							<label class="tbr_weight_semibold" for="status_aktif">Active</label>
						</div>
						<div class="radio-custom radio-primary">
							<input type="radio" id="status_tidakaktif" name="patient_status" value="1" {{ $patient->blocked == '1' ? 'checked' : '' }}>
							<label class="tbr_weight_semibold" for="status_tidakaktif">Deactive</label>
						</div>
						<div class="d-flex justify-content-between mt-4">
							<a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light tbr_btn-square">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
									<g id="Group_4073" data-name="Group 4073" transform="translate(-5 -5)">
										<rect id="Rectangle_1086" data-name="Rectangle 1086" width="2" height="14" rx="1" transform="translate(5 13) rotate(-90)" fill="#ffae25" opacity="0.3" />
										<path id="Path_295" data-name="Path 295" d="M3.707,15.707a1,1,0,0,1-1.414-1.414l6-6a1,1,0,0,1,1.383-.03l6,5.5a1,1,0,1,1-1.351,1.474L9.03,10.384Z" transform="translate(-3 21) rotate(-90)" fill="#ffae25" />
									</g>
								</svg>
							</a>
							<button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		@include('admin.include.modal-delete')
	</div>
@endsection
@section('blockfoot')
	<script>
		$('.tbr_patient').addClass('nav-expanded nav-active');
	</script>
	<script src="{{ asset('assets/js/default-ajax.js') }}"></script>
	<script src="{{ asset('assets/js/admin/patient-delete.js') }}"></script>
	<script>
		$("#delete-patient").on("click", function(event) {
			deleteData(event, $(this).data("id"), $(this).data("url"));
		})
	</script>
@endsection