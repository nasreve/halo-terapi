<div class="tbr_cart {{ $selectedService->count() ? "" : "d-none" }}">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tbr_cart_wrap">
                    <div class="tbr_cart_info w-75">
                        <p class="mb-0">Anda memesan {{ $selectedService->count() }} layanan</p>
                        <p class="mb-0 text-truncate">
                            @foreach ($selectedService as $service)
                                {!! $service->title !!}{{ $loop->last ? "" : ", " }}
                            @endforeach
                        </p>
                    </div>
                    <div class="tbr_cart_action">
                        <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-primary d-none d-md-block" onclick="window.location.href = '/therapist/order/step-2'">
                            <span class="mr-2">Selanjutnya</span>
                            <img src="{{ asset('/assets/svg/icons/icon_cart_next.svg') }}" alt="Selanjutnya">
                        </button>
                        <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_btn-square d-block d-md-none" onclick="window.location.href = '/therapist/order/step-2'">
                            <img src="{{ asset('/assets/svg/icons/icon_cart_next.svg') }}" alt="Selanjutnya">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>