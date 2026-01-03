<div class="card mt-0 mb-4">
	<div class="card-body p-4">
		<div class="tbr_image_and_label">
			@if ($therapist->status == "Menunggu")
				<div class="tbr_user_label tbr_user_label-warning">Waiting</div>
			@elseif ($therapist->status == "Disetujui")
				<div class="tbr_user_label tbr_user_label-success">Approved</div>
			@else
				<div class="tbr_user_label tbr_user_label-danger">Rejected</div>
			@endif
			<div class="tbr_image_box mb-3">
				@if ($therapist->photo_path)
					<img src="{{ Storage::url($therapist->photo_path) }}" alt="{{ $therapist->photo_name }}">
				@else
					<img src="{{ asset('assets/images/sample_therapist_01.png') }}" alt="{{ $therapist->photo_name }}">
				@endif
			</div>
		</div>
		<div class="tbr_block_info">
			<div>Nomor STR</div>
			<div>{{ $therapist->str_number }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Email</div>
			<div>{{ $therapist->email }}</div>
		</div>
		<div class="tbr_block_info">
			<div>Mendaftar pada</div>
			<div>{{ formatDate($therapist->created_at, 'd M Y \j\a\m H.i') }}</div>
		</div>
		<div class="mt-3">
			<button
				type="button"
				anim="ripple"
				id="delete-therapist"
				class="btn tbr_btn tbr_btn-light tbr_btn-square"
				data-id="{{ $therapist->id }}"
				data-url="{{ route('therapist.destroy', $therapist->id) }}">
				<img src="{{ asset('assets/svg/icon_trash.svg') }}" alt="Delete">
			</button>
		</div>
	</div>
</div>
<div class="card mt-0 mb-4 mb-lg-0">
	<div class="card-body px-4 py-3">
		<div class="tbr_block_info py-2">
			<div>Sumber Informasi</div>
			<div>{{ $therapist->source }}</div>
		</div>
	</div>
</div>