@extends('admin.layouts.app')
@section('title', 'Detail Terapis')
@section('content')
	<header class="page-header">
		<h2>Detail Terapis</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs mr-3">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<a href="{{ route('therapist.index') }}">
						<span>Terapis</span>
					</a>
				</li>
				<li>
					<span>Detail</span>
				</li>
			</ol>
		</div>
	</header>
	@include('admin.therapist.partials.alert')
	<div class="row tbr_edit_data pt-0">
		<div class="col-lg-3">
			@include('admin.therapist.partials.info')
		</div>
		<div class="col-lg-6">
			<div class="tabs tbr_tabs mt-0 mb-4 mb-lg-0">
				@include('admin.therapist.partials.nav-tabs')
				<div class="tab-content pb-3">
					<div class="tab-pane active show" id="personal-data" role="tabpanel">
						@include('admin.therapist.partials.personal-data')
					</div>
					<div class="tab-pane" id="experience" role="tabpanel">
						@include('admin.therapist.partials.experience')
					</div>
					<div class="tab-pane" id="service" role="tabpanel">
						@include('admin.therapist.partials.service')
					</div>
                    <div class="tab-pane" id="service-area" role="tabpanel">
						@include('admin.therapist.partials.service-area')
					</div>
					<div class="tab-pane" id="bank-account" role="tabpanel">
						@include('admin.therapist.partials.bank-account')
					</div>
					<div class="tab-pane" id="service-schedule" role="tabpanel">
						@include('admin.therapist.partials.service-schedule')
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			@include('admin.therapist.partials.status')
		</div>
		@include('admin.include.modal-delete')
	</div>
@endsection
@section('blockfoot')
	<script src="{{ asset('porto/vendor/autoNumeric-4.6.0/autoNumeric.min.js') }}"></script>
	<script src="{{ asset('assets/js/default-ajax.js') }}"></script>
	<script src="{{ asset('assets/js/admin/therapist-delete.js') }}"></script>
	<script src="{{ asset('assets/js/admin/service-therapist.js') }}"></script>
	<script>
		$(".number-separator").each(function() {
            new AutoNumeric(this, {
                allowDecimalPadding: false,
                minimumValue: 0,
                decimalCharacter: ",",
                digitGroupSeparator: ".",
				defaultValueOverride: "",
				modifyValueOnWheel: false
            });
        });

		$("#delete-therapist").on("click", function(event) {
			deleteData(event, $(this).data("id"), $(this).data("url"));
		})
	</script>
	<script>
		$('.tbr_therapist').addClass('nav-expanded nav-active');
	</script>
@endsection