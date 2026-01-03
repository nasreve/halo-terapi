<div class="text-center">
    <p><em>Kesepakatan hari & tanggal kunjungan dapat disepakati secara manual antara terapis dengan pasien.</em></p>
</div>
<input type="hidden" name="homecare">
<div class="invalid-feedback tbr_block_invalid_feedback mb-4" role="alert"></div>
<form action="{{ route('therapist.setting.updateHomecare') }}" method="POST" class="main_form" autocomplete="off">
    @csrf
    <div class="form-group">
        <textarea
            class="summernote d-none"
            id="homecare"
            name="homecare"
        >{{ $therapist->homecare }}</textarea>
    </div>
    <div class="text-right mt-4 pt-3">
        <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex">Kembali</a>
        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
    </div>
</form>