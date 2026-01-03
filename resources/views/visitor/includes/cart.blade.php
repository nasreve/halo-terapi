<div class="tbr_cart {{ $selectedService->count() ? "" : "d-none" }}">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tbr_cart_wrap">
                    <div class="tbr_cart_info w-65">
                        <p class="mb-0">Anda memesan {{ $selectedService->count() }} layanan</p>
                        <p class="mb-0 text-truncate cart-truncate">
                            @foreach ($selectedService as $service)
                                {!! $service->title !!}{{ $loop->last ? "" : ", " }}
                            @endforeach
                        </p>
                    </div>
                    <div class="tbr_cart_action">
                        @guest('patient')
                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-danger d-none d-md-block" onclick="openLoginModal()">
                                <span class="mr-2">Pilih Terapis</span>
                                <img class="mb-1" src="{{ asset('/assets/svg/icons/icon_cart_next.svg') }}" alt="Pilih Terapis">
                            </button>
                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-danger tbr_btn-square d-flex d-md-none" onclick="openLoginModal()">
                                <span class="mr-2">Pilih Terapis</span>
                                <img src="{{ asset('/assets/svg/icons/icon_cart_next.svg') }}" alt="Pilih Terapis">
                            </button>
                        @else
                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-danger d-none d-md-block" onclick="window.location.href = '/patient/order/step-2'">
                                <span class="mr-2">Pilih Terapis</span>
                                <img class="mb-1" src="{{ asset('/assets/svg/icons/icon_cart_next.svg') }}" alt="Pilih Terapis">
                            </button>
                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-danger tbr_btn-square d-dlex d-md-none" onclick="window.location.href = '/patient/order/step-2'">
                                <span class="mr-2">Pilih Terapis</span>
                                <img src="{{ asset('/assets/svg/icons/icon_cart_next.svg') }}" alt="Pilih Terapis">
                            </button>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>