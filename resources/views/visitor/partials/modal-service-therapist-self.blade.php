<div class="modal tbr_modal fade" id="modal-service-{{ $service->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <h3 class="tbr_weight-extra-bold tbr_section_title mb-3 pr-4">
                Layanan <span class="tbr_text-primary">{{ $service->title }}</span>
            </h3>
            {{ $service->description }}
            <div class="tbr_modal_action text-right mt-4 pt-1">
                <button type="button" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary" data-dismiss="modal">Kembali</button>
                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-success tbr_btn-order-modal ml-2 {{ modalCheckOrderSelfTherapist($service->id) ? "d-none" : "" }}">Pesan Sekarang</button>
                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn-cancel-modal ml-2 {{ modalCheckOrderSelfTherapist($service->id) ? "" : "d-none" }}">Batalkan</button>
            </div>
        </div>
    </div>
</div>