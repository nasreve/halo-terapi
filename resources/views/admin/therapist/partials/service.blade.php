<p class="tbr_weight-semi-bold mb-0">Layanan</p>
<p class="help-block">Hanya diperbolehkan menambah atau mengubah harga layanan.</p>
@if(\App\Models\Setting::first()->use_service_fee_nominal)
<div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
	<i class="fa fa-exclamation-triangle mr-2"></i>
	<span><strong>Perhatian:</strong> Saat ini sistem menggunakan <em>Fee Nominal</em>. Harga layanan terapis di bawah ini tidak akan digunakan. Harga diatur di <a href="{{ route('system.form') }}">Pengaturan Sistem &rarr; Fee Layanan</a>.</span>
</div>
@endif
<form action="{{ route('therapist.updateService', $therapist->id) }}" method="POST" class="service-form">
	@csrf
	<div class="tbr_sevice_group">
		{{-- Yang di loop gaes... --}}
		@foreach($therapist->services->sortBy('id') as $service)
		<input type="hidden" name="number_of_service" value="{{ $therapist->services->count() }}">
		<div class="tbr_service_item">
			<p class="mb-2">{{$service->title}}</p>
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6">
					<div class="form-group mb-3 mb-lg-0">
						<div class="input-group tbr_fix_ig">
							<input name="service_id[]" id="service_id-{{ $service->id }}" value="{{ $service->pivot->service_id }}" hidden>
							<div class="input-group-prepend">Rp</div>
							<input class="form-control number-separator" type="text" name="rate[]" id="rate-{{ $service->id }}" value="{{ formatNumberTwoComas($service->pivot->rate) }}" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row no-gutters justify-content-center align-items-center">
						<div class="col-6">
							<div class="radio-custom radio-primary">
								<input type="radio" id="approved-{{ $service->id }}" name="service[{{ $service->id }}]" value="Diterima" {{ $service->pivot->status == 'Diterima' ? 'checked':'' }}>
								<label class="tbr_weight_semibold" for="approved-{{ $service->id }}">Disetujui</label>
							</div>
						</div>
						<div class="col-6">
							<div class="radio-custom radio-primary ml-3">
								<input type="radio" id="rejected-{{ $service->id }}" name="service[{{ $service->id }}]" value="Ditolak" {{ $service->pivot->status == 'Ditolak' ? 'checked':'' }}>
								<label class="tbr_weight_semibold" for="rejected-{{ $service->id }}">Ditolak</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@if ($therapist->services->isEmpty())
	<div class="d-flex justify-content-end mt-4 mb-3">
		<button type="button" class="btn tbr_btn tbr_btn-primary tbr_disabled" id="btn-update-service" disabled>Simpan</button>
	</div>
	@else
	<div class="d-flex justify-content-end mt-4 mb-3">
		<button type="button" class="btn tbr_btn tbr_btn-primary" id="btn-update-service">Simpan</button>
	</div>
	@endif
</form>