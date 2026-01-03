@extends('admin.layouts.app')
@section('title', 'Sistem')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/summernote/summernote.min.css') }}">
@endsection
@section('content')
	<header class="page-header">
		<h2>Sistem</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<a href="{{ route('my-profile.form') }}">
						<span>Pengaturan</span>
					</a>
				</li>
				<li>
					<span>Sistem</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row justify-content-center">
		<div class="col-xl-9">
			<div class="tabs tbr_tabs px-0 px-xl-4 mb-0">
				<ul class="nav nav-tabs" id="tbr_system_tab" role="tablist">
					<li class="nav-item active">
						<a class="nav-link" id="fee-tab" data-toggle="tab" href="#fee" role="tab">Persentase Fee</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab">Rekening</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="transport-tab" data-toggle="tab" href="#transport" role="tab">Biaya Transport</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active show" id="fee" role="tabpanel">
						<div class="mb-4">
							<h4 class="tbr_form_title my-0">Persentase Fee</h4>
							<p class="help-block m-0">
								Silakan tentukan besaran komisi untuk terapis, vendor, dan juga referrer.
							</p>
						</div>
						<form action="{{ route('fee.update') }}" method="POST" class="fee-form" autocomplete="off">
							@csrf
							<div class="row justify-content-center no-gutters">
								<div class="col-xl-8 col-lg-8 col-sm-12 col-12">
									<div class="form-group row align-items-center">
										<label for="therapist_fee" class="text-lg-right col-lg-2 mb-lg-0">Terapis</label>
										<div class="input-group tbr_fix_ig col-lg-10">
											<input class="form-control" type="number" min="0" max="100" name="therapist_fee" id="therapist_fee" value="{{ $setting->therapist_fee }}">
											<div class="input-group-append">
												<img src="{{ asset('assets/svg/icon_form_percent.svg') }}" alt="icon_form_percent">
											</div>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="vendor_fee" class="text-lg-right col-lg-2 mb-lg-0">Vendor</label>
										<div class="input-group tbr_fix_ig col-lg-10">
											<input class="form-control" type="number" min="0" max="100" name="vendor_fee" id="vendor_fee" value="{{ $setting->vendor_fee }}">
											<div class="input-group-append">
												<img src="{{ asset('assets/svg/icon_form_percent.svg') }}" alt="icon_form_percent">
											</div>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="referrer_fee" class="text-lg-right col-lg-2 mb-lg-0">Referrer</label>
										<div class="input-group tbr_fix_ig col-lg-10">
											<input class="form-control" type="number" min="0" max="100" name="referrer_fee" id="referrer_fee" value="{{ $setting->referrer_fee }}">
											<div class="input-group-append">
												<img src="{{ asset('assets/svg/icon_form_percent.svg') }}" alt="icon_form_percent">
											</div>
										</div>
									</div>
									<div class="form-group d-flex justify-content-end pt-3">
										<button type="button" anim="ripple" class="btn tbr_btn tbr_btn-primary" id="showWarning">
											Simpan
										</button>
									</div>
								</div>
							</div>
							<div class="mt-4 pt-2">
								<a href="javascript:void(0)" id="openHelpBlock" class="d-flex align-items-center justify-content-center">
									<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
										<g id="menu-arrow-circle">
											<rect id="Rectangle_1441" data-name="Rectangle 1441" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#ffae25" opacity="0"/>
											<path id="Path_519" data-name="Path 519" d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,16a1,1,0,1,1,1-1A1,1,0,0,1,12,18Zm1-5.16V14a1,1,0,0,1-2,0V12a1,1,0,0,1,1-1,1.5,1.5,0,1,0-1.5-1.5,1,1,0,0,1-2,0A3.5,3.5,0,1,1,13,12.84Z" fill="#ffae25"/>
										</g>
									</svg>
									<span class="tbr_text-secondary ml-2">Ada kendala saat input Fee?</span>
								</a>
								<div id="helpBlock" class="tbr_toggle_d_none">
									<div class="tbr_help_block d-flex justify-content-center align-items-center mt-3">
										JIka tidak bisa menambahkan nilai pada salah satu form, berarti
										nilai dari ke 3 form tersebut sudah mencapai 100%. Anda tidak
										bisa menambahkan nilai lebih dari 100%.
										<button type="button" class="close ml-2" id="closeHelpBlock" data-dismiss="alert" aria-hidden="true">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<g id="Layer_2" data-name="Layer 2" opacity="0.5">
													<g id="close">
														<rect id="Rectangle_1493" data-name="Rectangle 1493" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#777" opacity="0"/>
														<path id="Path_553" data-name="Path 553" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#777"/>
													</g>
												</g>
											</svg>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="account" role="tabpanel">
						<div class="mb-4">
							<h4 class="tbr_form_title my-0">Rekening</h4>
							<p class="help-block m-0">
								Transaksi antara pasien atau terapis dengan pihak {{ config('app.name') }}.
							</p>
						</div>
						<form action="{{ route('account.update') }}" method="POST" class="account-form" autocomplete="off">
							@csrf
							<div class="row justify-content-center no-gutters">
								<div class="col-xl-10 col-lg-10 col-sm-12 col-12">
                                    <div class="form-group row align-items-start pt-0">
										<div class="col-md-4 text-md-right mb-2 mb-md-0">
                                            <label for="bank_name" class="mb-0">
												Logo Bank
												<span class="help-block">required</span>
											</label>
										</div>
										<div class="col-md-8">
                                            <div class="tbr_photo_preview">
												@if ($setting->logo_path)
													<img id="output" src="{{ Storage::url($setting->logo_path) }}">
												@else
													<img id="output" src="{{ asset('/assets/svg/etc/Bank-Default.svg') }}">
												@endif
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input
                                                            name="logo_path"
                                                            type="file"
                                                            class="custom-file-input"
                                                            id="photo"
                                                            accept="image/png, image/gif, image/jpeg"
                                                        >
                                                        <label class="custom-file-label" for="photo">{{ $setting->logo_name }}</label>
                                                    </div>
                                                </div>
												@if ($setting->logo_path)
													<input class="form-control" type="hidden" name="logo_path" value="{{ $setting->logo_path }}" id="hidden-logo-path">
												@endif
                                                <p class="help-block mt-1">File yang diupload harus ber-extensi jpg, jpeg, dan png. Dimensi 180 x 65 pixels dengan size maksimal 200 KB.</p>
                                            </div>
										</div>
									</div>
									<div class="form-group row align-items-center pt-0">
										<div class="col-md-4 text-md-right mb-2 mb-md-0">
											<label for="bank_name" class="mb-0">
												Nama Bank
												<span class="help-block">required</span>
											</label>
										</div>
										<div class="col-md-8">
											<input type="text" name="bank_name" class="form-control" id="bank_name" value="{{ $setting->bank_name }}">
										</div>
									</div>
									<div class="form-group row align-items-center pt-0">
										<div class="col-md-4 text-md-right mb-2 mb-md-0">
											<label for="account_number" class="mb-0">
												Nomor Rekening
												<span class="help-block">required</span>
											</label>
										</div>
										<div class="col-md-8">
											<input type="text" name="account_number" class="form-control" id="account_number" value="{{ $setting->account_number }}">
										</div>
									</div>
									<div class="form-group row align-items-center pt-0">
										<div class="col-md-4 text-md-right mb-2 mb-md-0">
											<label for="bank_account" class="mb-0">
												Atas Nama
												<span class="help-block">required</span>
											</label>
										</div>
										<div class="col-md-8">
											<input type="text" name="bank_account" class="form-control" id="bank_account" value="{{ $setting->bank_account }}">
										</div>
									</div>
									<div class="form-group d-flex justify-content-end pt-3">
										<button type="button" anim="ripple" class="btn tbr_btn tbr_btn-primary" id="btn-update-account">
											Simpan
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="transport" role="tabpanel">
						<div class="mb-4">
							<h4 class="tbr_form_title my-0">Transport</h4>
							<p class="help-block m-0">
								Catatan biaya transport terapi saat pasien melakukan pemesanan.
							</p>
						</div>
						<form action="{{ route('transport.update') }}" method="POST" class="transport-form" autocomplete="off">
							@csrf
							<div class="form-group">
								<textarea name="transport_note" id="transport_note" class="summernote">{{ $setting->transport_note }}</textarea>
							</div>
							<div class="form-group d-flex justify-content-end pt-3">
								<button type="button" anim="ripple" class="btn tbr_btn tbr_btn-primary" id="btn-update-transport">
									Simpan
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fee-warning-modal" class="modal-block mfp-hide tbr_modal_notif">
		<section class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
						<div class="text-center">
							<img src="{{ asset('assets/svg/icon_question_orange.svg') }}" alt="icon_question_orange" class="mt-2 mb-3">
							<h4 class="mt-0 mb-2">
								Anda yakin?
							</h4>
							<p>
								Pembaruan fee akan diterapkan untuk vendor,
								semua terapis, dan juga semua referrer.
							</p>
							<div class="d-flex justify-content-center mt-4 mb-3">
								<button type="button" anim="ripple" class="btn tbr_btn tbr_btn-light modal-dismiss mx-1">
									Batalkan
								</button>
								<button type="button" anim="ripple" class="btn tbr_btn tbr_btn-warning mx-1" id="apply-button">
									Ya, terapkan
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
@section('blockfoot')
	<script src="{{ asset('porto/vendor/summernote/summernote.min.js') }}"></script>
	<script src="{{ asset('assets/js/admin/fee-ajax.js') }}"></script>
	<script src="{{ asset('assets/js/admin/account-ajax.js') }}"></script>
	<script src="{{ asset('assets/js/admin/transport-ajax.js') }}"></script>
	<script>
		$(".summernote").summernote({
			height: 150,
			toolbar: [
				["style", ["style"]],
				["font", ["bold", "underline", "clear"]],
				["fontname", ["fontname"]],
				["color", ["color"]],
				["para", ["ul", "ol", "paragraph"]],
				["table", ["table"]],
				["insert", ["link"]],
				["view", ["fullscreen", "codeview", "help"]],
			],
		});

		$(document).ready(function() {
			$("#openHelpBlock").click(function() {
				$("#helpBlock").toggle("fast");
			});

			$("#closeHelpBlock").click(function() {
				$("#helpBlock").hide("fast");
			});
		});

		$("[type='number']").on("input", function () {
			let maxValue = 100;
			let current = $(this);

			if (parseInt(current.val()) > maxValue) {
				current.val(maxValue);
			}
		})

        /* ======================================
        * Custom file input
        ====================================== */
        $(".custom-file-input").on("change", function () {
			$(this).parents(".input-group").find('.invalid-feedback').remove();

			const prevText = $(".custom-file-label [for='photo']").html();
			const fileSize = this.files[0].size / 1024;

			if (fileSize > 200) {
				$(this).parents(".input-group").append(`
                    <span class="invalid-feedback d-block" role="alert">
                        Ukuran file maksimal 200 KB.
                    </span>
                `);

                $(this).val(null);

                setTimeout(() => {
                    $(this).next().html(prevText);
                }, 100);
			} else {
				let fileName = $(this).val().split("\\").pop();
				$(this).next(".custom-file-label").addClass("selected").html(fileName);
				$("#hidden-logo-path").remove();

				$("#output").attr("src", window.URL.createObjectURL(this.files[0]));
			}

        });

		$('.tbr_setting').addClass('nav-active');
		$('.tbr_setting').addClass('nav-expanded');
		$('.tbr_setting_system').addClass('nav-active');
	</script>
@endsection