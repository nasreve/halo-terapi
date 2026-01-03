<form action="{{ route('therapist.setting.updateAccount') }}" method="POST" class="main_form" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <label for="bank_name" class="mb-1">Nama Bank</label>
                <input
                    type="text"
                    class="form-control"
                    id="bank_name"
                    name="bank_name"
                    value="{{ $therapist->bank_name }}"
                    placeholder=""
                    tabindex=""
                    spellcheck="false"
                >
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <label for="bank_account" class="mb-1">Atas Nama</label>
                <input
                    type="text"
                    class="form-control"
                    id="bank_account"
                    name="bank_account"
                    value="{{ $therapist->bank_account }}"
                    placeholder=""
                    tabindex=""
                >
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <label for="account_number" class="mb-1">Nomor Rekening</label>
                <input
                    type="text"
                    class="form-control"
                    id="account_number"
                    name="account_number"
                    value="{{ $therapist->account_number }}"
                    placeholder=""
                    tabindex=""
                >
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
    </div>
    <div class="text-right mt-4">
        <a href="{{ url()->previous() }}" anim="ripple" class="btn tbr_btn tbr_btn-light d-inline-flex">Kembali</a>
        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex ml-3">Simpan</button>
    </div>
</form>