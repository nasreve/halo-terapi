<div class="modal tbr_modal fade" id="modal-service-{{ $service->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light tbr_btn-circle modal-dismiss tbr_modal_dismiss" data-dismiss="modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="Layer_2" data-name="Layer 2" opacity="0.7">
                        <g id="close">
                            <rect id="Rectangle_1936" data-name="Rectangle 1936" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#8a949b" opacity="0"/>
                            <path id="Path_751" data-name="Path 751" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#8a949b"/>
                        </g>
                    </g>
                </svg>
            </button>
            <h3 class="tbr_weight-extra-bold tbr_section_title mb-3 pr-4">
                Layanan <span class="tbr_text-primary">{{ $service->title }}</span>
            </h3>
            {{ $service->description }}
            <div class="tbr_modal_action text-right mt-4 pt-1">
                <button type="button" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary" data-dismiss="modal">Kembali</button>
                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-success tbr_btn-order-modal ml-2 {{ modalCheckOrder($service->id) ? "d-none" : "" }}">Pesan Sekarang</button>
                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light-danger tbr_btn-cancel-modal ml-2 {{ modalCheckOrder($service->id) ? "" : "d-none" }}">Batalkan</button>
            </div>
        </div>
    </div>
</div>