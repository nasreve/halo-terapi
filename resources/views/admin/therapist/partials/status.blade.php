<div class="card mt-0 mb-o">
	<div class="card-body p-4">
		<form action="{{ route('therapist.update', $therapist->id) }}" method="POST" class="main_form">
			@csrf
			@method('PUT')
			<p class="card-label mb-2">Status</p>
			<p class="help-block">Status penerimaan terapis</p>
			<div class="radio-custom radio-primary">
				<input type="radio" id="waiting" name="status" value="Menunggu" {{ $therapist->status == 'Menunggu' ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="waiting">Menunggu</label>
			</div>
			<div class="radio-custom radio-primary">
				<input type="radio" id="approved" name="status" value="Disetujui" {{ $therapist->status == 'Disetujui' ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="approved">Disetujui</label>
			</div>
			<div class="radio-custom radio-primary">
				<input type="radio" id="rejected" name="status" value="Ditolak" {{ $therapist->status == 'Ditolak' ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="rejected">Ditolak</label>
			</div>

			<p class="help-block mt-4">Status akun terapis</p>
			<div class="radio-custom radio-primary">
				<input type="radio" id="active" name="therapist_status" value="0" {{ $therapist->blocked == '0' ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="active">Active</label>
			</div>
			<div class="radio-custom radio-primary">
				<input type="radio" id="deactive" name="therapist_status" value="1" {{ $therapist->blocked == '1' ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="deactive">Deactive</label>
			</div>
			<span class="help-block tbr_label_block">
				<em>Tidak bisa mengakses halamannya dan tidak ditampilkan pada halaman pasien.</em>
			</span>
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