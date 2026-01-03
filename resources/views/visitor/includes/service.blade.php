<section class="tbr_section tbt_section_services" id="SectionService">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-10 col-12">
				<div class="text-center">
					<h2 class="tbr_weight-extra-bold tbr_section_title mb-3">
						Layanan <span class="tbr_text-primary">haloterapi</span>
					</h2>
					<p class="tbr_lead mb-0">
						Haloterapi menawarkan berbagai macam layanan terapi.
                        Tinggal pilih layanan di bawah yang sesuai, tanpa harus pergi ke klinik.
					</p>
				</div>
			</div>
		</div>
        <div class="row mt-5">
            <div class="col">
                <form action="" method="" autocomplete="off">
                    <div class="tbr_services_column">
                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-xl-3 col-lg-3 col-md-4 col-6 tbr_column">
                                    <div class="tbr_service_card">
                                        <input type="checkbox" id="service-{{ $service->id }}" name="service" value="{{ $service->id }}" class="d-none" {{ checkedOrder($service->id) }}>
                                        <label for="service-{{ $service->id }}" class="radio" anim="ripple"></label>
                                        <div class="tbr_sc_check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24.3" height="18.245" viewBox="0 0 24.3 18.245">
                                                <path id="Path_761" data-name="Path 761" d="M12.878,24.2a1.515,1.515,0,0,1-1.106-.485L4.41,15.884a1.516,1.516,0,1,1,2.212-2.075l6.241,6.65L25.6,6.523a1.515,1.515,0,1,1,2.242,2.03L14,23.7a1.515,1.515,0,0,1-1.106.5Z" transform="translate(-3.999 -5.956)" fill="#ddd"/>
                                            </svg>
                                        </div>
                                        <h4>{{ $service->title }}</h4>
                                        <p>{{ Str::limit($service->description, 65, $end='...') }}</p>
                                        <a href="" class="tbr_text-success d-block mb-4" data-toggle="modal" data-target="#modal-service-{{ $service->id }}"><em>Selengkapnya</em></a>
                                        <div class="tbr_btn_group">
                                            <button type="button" class="btn tbr_btn tbr_btn-success tbr_btn_order">Pesan</button>
                                            <button type="button" class="btn tbr_btn tbr_btn-light-danger tbr_btn_cancel">Batalkan</button>
                                        </div>
                                    </div>

                                    @include('visitor.partials.modal-service', ['service' => $service])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('visitor.includes.cart')