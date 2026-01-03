<div id="delete" class="modal-block tbr_modal_delete mfp-hide tbr_modal_notif">
    <section class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
                    <div class="text-center">
                        <img src="{{ asset('assets/svg/icon_question_danger.svg') }}" alt="icon_question_orange" class="mt-2 mb-3">
                        <h4 class="mt-0 mb-2">
                            Anda yakin?
                        </h4>
                        <p>
                            Data akan dihapus dari database secara permanen.
                            Anda tidak bisa mengembalikannya lagi.
                        </p>
                    </div>
                    <div class="d-flex justify-content-center mt-4 mb-3">
                        <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light modal-dismiss mx-1">
                            Batalkan
                        </button>
                        <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-danger delete mx-1" id="apply-button">
                            Ya, hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>