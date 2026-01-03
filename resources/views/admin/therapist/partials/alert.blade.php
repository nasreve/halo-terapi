{{-- Alert ini muncul ketika ada layanan baru dari therapist tapi belum ada harga. Dan belum disetujui atau ditolak (radio button belum dipilih) --}}
@foreach ($therapist->services as $service)
	@if ($service->pivot->rate == "" || $service->pivot->status == "")
		<div class="row">
			<div class="col">
				<div class="card mb-4">
					<div class="card-body px-3 py-3">
						<div class="d-flex justify-content-start align-items-center tbr_card_alert">
							<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
								<g id="info">
									<rect id="Rectangle_1839" data-name="Rectangle 1839" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#ffae25" opacity="0"/>
									<path id="Path_718" data-name="Path 718" d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" fill="#ffae25"/>
									<circle id="Ellipse_205" data-name="Ellipse 205" cx="1" cy="1" r="1" transform="translate(11 7)" fill="#ffae25"/>
									<path id="Path_719" data-name="Path 719" d="M12,10a1,1,0,0,0-1,1v5a1,1,0,0,0,2,0V11A1,1,0,0,0,12,10Z" fill="#ffae25"/>
								</g>
							</svg>
							<span class="tbr_text-warning ml-3">Terapis menambahkan layanan baru! Terapis menunggu Anda untuk segera memberikan harga pada layanan yang sudah dipilih.</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	@break
	@endif
@endforeach
