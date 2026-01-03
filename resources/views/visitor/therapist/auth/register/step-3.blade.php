@extends('visitor.patient.auth.layouts.app')
@section('title', 'Register Step 3')
@section('blockhead')
	<link rel="stylesheet" href="{{ asset('porto/vendor/summernote/summernote-bs4.css') }}" />
@endsection
@section('content')
	<section class="tbr_auth_wrap">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="card tbr_card tbr_card-lg">
						<div class="card-body">
							<div class="row mb-4 pb-2">
								<div class="col">
									<ul class="tbr_wizard_label">
										<li class="tbr_active"><span>1</span></li>
										<li class="tbr_active"><span>2</span></li>
										<li class="tbr_active"><span>3</span></li>
										<li><span>4</span></li>
									</ul>
								</div>
							</div>

                            <div class="text-center">
                                <h4 class="tbr_weight-extra-bold tbr_section_title tbr_text-primary mb-2">Pengalaman</h4>
                                <div class="row justify-content-center">
                                    <div class="col-xl-11 col-lg-11 col-md-11 col-12">
                                        <p class="mb-4 pb-2">
                                            Formulir di bawah ini wajib untuk diisi semua.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('therapist.register.step3submit') }}" method="POST" class="main_form">
                                @csrf
                                <div class="accordion tbr_accordion" id="accordion">
                                    <div class="tbr_accordion_item">
                                        <button
                                            class="btn"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-1"
                                            aria-expanded="true"
                                            aria-controls="collapse-1"
                                        >
                                            <h4 class="w-100 mr-2">Riwayat pendidikan formal</h4>
                                            <div class="tbr_accordion_icon"></div>
                                        </button>
                                        <span class="invalid-feedback tbr_block_invalid_feedback invalid-feedback-edu_history mb-4" role="alert"></span>
                                        <div id="collapse-1" class="collapse show" data-parent="#accordion">
                                            <div class="tbr_accordion_content pt-0">
                                                <textarea
                                                    class="summernote d-none"
                                                    id="edu_history"
                                                    name="edu_history"
                                                >{{ $therapist->edu_history }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbr_accordion_item">
                                        <button
                                            class="btn"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-2"
                                            aria-expanded="false"
                                            aria-controls="collapse-2"
                                        >
                                            <h4 class="w-100 mr-2">Riwayat seminar dan pelatihan</h4>
                                            <div class="tbr_accordion_icon"></div>
                                        </button>
                                        <span class="invalid-feedback tbr_block_invalid_feedback invalid-feedback-workshop_history mb-4" role="alert"></span>
                                        <div id="collapse-2" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content pt-0">
                                                <textarea
                                                    class="summernote d-none"
                                                    id="workshop_history"
                                                    name="workshop_history"
                                                >{{ $therapist->workshop_history }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbr_accordion_item">
                                        <button
                                            class="btn"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-3"
                                            aria-expanded="false"
                                            aria-controls="collapse-3"
                                        >
                                            <h4 class="w-100 mr-2">Pengalaman praktik kerja lapangan (PKL)</h4>
                                            <div class="tbr_accordion_icon"></div>
                                        </button>
                                        <span class="invalid-feedback tbr_block_invalid_feedback invalid-feedback-internship_experience mb-4" role="alert"></span>
                                        <div id="collapse-3" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content pt-0">
                                                <textarea
                                                    class="summernote d-none"
                                                    id="internship_experience"
                                                    name="internship_experience"
                                                >{{ $therapist->internship_experience }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tbr_accordion_item">
                                        <button
                                            class="btn mb-0"
                                            type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-4"
                                            aria-expanded="false"
                                            aria-controls="collapse-4"
                                        >
                                            <h4 class="w-100 mr-2">Pengalaman kerja</h4>
                                            <div class="tbr_accordion_icon"></div>
                                        </button>
                                        <span class="invalid-feedback tbr_block_invalid_feedback invalid-feedback-job_experience mt-4 mb-0" role="alert"></span>
                                        <div id="collapse-4" class="collapse" data-parent="#accordion">
                                            <div class="tbr_accordion_content tbr_accordion_last">
                                                <textarea
                                                    class="summernote d-none"
                                                    id="job_experience"
                                                    name="job_experience"
                                                >{{ $therapist->job_experience }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tbr_wizard_nav mt-4 pt-2">
                                    <a href="{{ route('therapist.register.step-2') }}" anim="ripple" class="btn tbr_btn-outline tbr_btn-o-primary tbr_wizard_prev">
                                        <i class="icons icon-arrow-left"></i> Sebelumnya
                                    </a>
                                    <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary tbr_wizard_next">
                                        Selanjutnya <i class="icons icon-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('blockfoot')
    <script src="{{ asset('assets/js/visitor/therapist/register-ajax-step-3.js') }}"></script>
	<script src="{{ asset('porto/vendor/summernote/summernote-bs4.js') }}"></script>
	<script>
		$(".summernote").summernote({
			styleWithSpan: false,
			minHeight: 160,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link']],
				['view', ['fullscreen', 'codeview']],
				['help', ['help']]
			],
		});
	</script>
@endsection