<div class="card mt-0 mb-4">
	<div class="card-body p-4">
		<p class="tbr_weight-semi-bold mb-2">Follow Up</p>
		<p class="help-block mb-4">Mempercepat proses follow up silakan manfaatkan tombol di bawah.</p>
		<div class="d-flex tbr_group_cta">
			<a href="tel:+62{{ $order->buyer_phone }}" target="_blank" anim="ripple" id="delete-patient" class="btn tbr_btn tbr_btn-light-danger tbr_btn-square mr-3">
				<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
					<g id="phone-call">
						<rect id="Rectangle_1755" data-name="Rectangle 1755" width="24" height="24" fill="#f64e60" opacity="0"/>
						<path id="Path_702" data-name="Path 702" d="M13,8a3,3,0,0,1,3,3,1,1,0,0,0,2,0,5,5,0,0,0-5-5,1,1,0,1,0,0,2Z" fill="#f64e60"/>
						<path id="Path_703" data-name="Path 703" d="M13,4a7,7,0,0,1,7,7,1,1,0,0,0,2,0,9,9,0,0,0-9-9,1,1,0,0,0,0,2Z" fill="#f64e60"/>
						<path id="Path_704" data-name="Path 704" d="M21.75,15.91a1,1,0,0,0-.72-.65l-6-1.37a1,1,0,0,0-.92.26c-.14.13-.15.14-.8,1.38a9.91,9.91,0,0,1-4.87-4.89C9.71,10,9.72,10,9.85,9.85a1,1,0,0,0,.26-.92L8.74,3a1,1,0,0,0-.65-.72,3.79,3.79,0,0,0-.72-.18A3.94,3.94,0,0,0,6.6,2,4.6,4.6,0,0,0,2,6.6,15.42,15.42,0,0,0,17.4,22,4.6,4.6,0,0,0,22,17.4a4.77,4.77,0,0,0-.06-.76A4.34,4.34,0,0,0,21.75,15.91ZM17.4,20A13.41,13.41,0,0,1,4,6.6,2.61,2.61,0,0,1,6.6,4h.33L8,8.64l-.54.28c-.86.45-1.54.81-1.18,1.59a11.85,11.85,0,0,0,7.18,7.21c.84.34,1.17-.29,1.62-1.16l.29-.55L20,17.07v.33A2.61,2.61,0,0,1,17.4,20Z" fill="#f64e60"/>
					</g>
				</svg>
			</a>
			<a href="mailto:{{ $order->buyer_email }}" target="_blank" anim="ripple" id="delete-patient" class="btn tbr_btn tbr_btn-light-info tbr_btn-square mr-3">
				<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
					<g id="email">
						<rect id="Rectangle_1754" data-name="Rectangle 1754" width="24" height="24" fill="#6866e9" opacity="0"/>
						<path id="Path_701" data-name="Path 701" d="M19,4H5A3,3,0,0,0,2,7V17a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V7a3,3,0,0,0-3-3Zm-.67,2L12,10.75,5.67,6ZM19,18H5a1,1,0,0,1-1-1V7.25l7.4,5.55a1,1,0,0,0,1.2,0L20,7.25V17A1,1,0,0,1,19,18Z" fill="#6866e9"/>
					</g>
				</svg>
			</a>
			<a href="https://api.whatsapp.com/send/?phone=62{{ $order->buyer_whatsapp }}" target="_blank" anim="ripple" id="delete-patient" class="btn tbr_btn tbr_btn-light-primary tbr_btn-square mr-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="20.097" height="20.067" viewBox="0 0 20.097 20.067">
					<g id="Group_4078" data-name="Group 4078" transform="translate(-1167.975 -328)">
						<path id="Path_443" data-name="Path 443" d="M19.07,4.93a10,10,0,0,0-16.28,11,1.06,1.06,0,0,1,.09.64L2,20.8A.994.994,0,0,0,3,22h.2l4.28-.86a1.26,1.26,0,0,1,.64.09,10,10,0,0,0,11-16.28Zm.83,8.36a8,8,0,0,1-11,6.08,3.26,3.26,0,0,0-1.25-.26,3.43,3.43,0,0,0-.56.05l-2.82.57.57-2.82a3.09,3.09,0,0,0-.21-1.81A8,8,0,1,1,19.9,13.29Z" transform="translate(1166 326.022)" fill="#24cc63"/>
						<path id="Path_533" data-name="Path 533" d="M13.845,11.781l-.006.051c-1.5-.748-1.658-.848-1.851-.557-.134.2-.526.658-.644.793s-.238.143-.441.051a5.539,5.539,0,0,1-1.64-1.013A6.191,6.191,0,0,1,8.13,9.693c-.2-.345.218-.394.6-1.115a.375.375,0,0,0-.017-.358c-.051-.1-.459-1.106-.629-1.505s-.332-.348-.459-.348a1.016,1.016,0,0,0-.934.235c-1.1,1.211-.824,2.46.119,3.788,1.852,2.424,2.839,2.87,4.643,3.49a2.823,2.823,0,0,0,1.283.083,2.1,2.1,0,0,0,1.376-.973,1.689,1.689,0,0,0,.123-.972c-.05-.092-.184-.143-.389-.235Z" transform="translate(1167.903 327.858)" fill="#24cc63"/>
					</g>
				</svg>
			</a>
		</div>
	</div>
</div>
<div class="card mt-0 mb-0">
	<div class="card-body p-4">
		<form action="{{ route('order.update', $order->id) }}" method="post" class="main_form">
			@csrf
			@method('PATCH')
			<p class="card-label mb-2">Status</p>
			<p class="help-block">Status pembayaran oleh pasien</p>
			<div class="radio-custom radio-primary">
				<input type="radio" id="unpaid" name="payment_status" value="Belum Dibayar" {{ $order->payment_status === "Belum Dibayar" ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="unpaid">Belum Dibayar</label>
			</div>
			<div class="radio-custom radio-primary">
				<input type="radio" id="paid" name="payment_status" value="Sudah Dibayar" {{ $order->payment_status === "Sudah Dibayar" ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="paid">Sudah Dibayar</label>
			</div>
			<p class="help-block mt-4">Status persetujuan terapis</p>
			<div class="radio-custom radio-primary">
				<input type="radio" id="waiting" name="order_status" value="Menunggu" {{ $order->order_status === "Menunggu" ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="waiting">Menunggu</label>
			</div>
			<div class="radio-custom radio-primary">
				<input type="radio" id="scheduled" name="order_status" value="Terjadwal" {{ $order->order_status === "Terjadwal" ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="scheduled">Terjadwal</label>
			</div>
			<div class="radio-custom radio-primary">
				<input type="radio" id="done" name="order_status" value="Selesai" {{ $order->order_status === "Selesai" ? 'checked' : '' }}>
				<label class="tbr_weight_semibold" for="done">Selesai</label>
			</div>
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