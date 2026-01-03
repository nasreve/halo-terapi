<div class="modal tbr_modal tbr_modal_login fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
	<div class="modal-dialog">
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
			<div class="text-center">
				<h3 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Login</h3>
				<div class="row justify-content-center">
					<div class="col-xl-10 col-lg-10 col-md-10 col-12">
						<p class="mb-4">
							Silakan masuk menggunakan email dan
							password yang sudah Anda miliki.
						</p>
					</div>
				</div>
			</div>
			<form action="{{ route('patient.login') }}" method="POST" class="tbr_form_auth tbr_patient_form tbr_form_active tbr_login_form" id="Area1">
				@csrf
				<input type="hidden" name="cart" value="" disabled>
				<input type="hidden" name="username" value="" disabled>
				<div class="form-group mb-3">
					<input
						type="email"
						class="form-control"
						id="email"
						name="email"
						value=""
						placeholder="Email"
						tabindex=""
						spellcheck="false"
						required
					>
				</div>
				<div class="form-group mb-3">
					<input
						type="password"
						class="form-control"
						id="password"
						name="password"
						value=""
						placeholder="Password"
						tabindex=""
						spellcheck="false"
						required
					>
				</div>
				<div class="row no-gutters mb-3">
					<div class="col-6">
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="remember" name="remember">
								<label class="custom-control-label" for="remember">Remember Me</label>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="text-right">
							<a href="{{ url('/patient/forgot-password') }}" class="tbr_text-success">Forgot Password</a>
						</div>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_btn_login mr-auto ml-auto">Login</button>
					<p class="pt-2 mt-4 mb-0">
						Jika belum punya akun silakan register dulu.
						<a href="{{ route('patient.register') }}" class="tbr_text-success">Register</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</div>