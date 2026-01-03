@extends('admin.layouts.app')
@section('title', 'Detail Referrer')
@section('content')
	<header class="page-header">
		<h2>Detail Referrer</h2>
		<div class="right-wrapper text-right">
			<ol class="breadcrumbs mr-3">
				<li>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/svg/icon_home.svg') }}">
					</a>
				</li>
				<li>
					<a href="{{ route('referrer.index') }}">
						<span>Referrer</span>
					</a>
				</li>
				<li>
					<span>Detail</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row tbr_edit_data">
		<div class="col-lg-3">
			<div class="card mt-0 mb-4">
				<div class="card-body pt-3 pr-4 pb-4 pl-4">
					<div class="tbr_block_info">
						<div>Kode unik referrer</div>
						<div><em class="tbr_text-warning">{{ $referrer->unique_reff }}</em></div>
						<div class="tbr_clipboard">
							<button
								type="button"
								anim="ripple"
								class="btn tbr_btn tbr_btn-light tbr_btn-square copy"
								data-toggle="tooltip"
								data-placement="bottom"
								title="Copy referral URL"
								@if ($referrer->therapist()->exists())
									data-clipboard-text="{{ config('app.url') }}therapist/{{ $referrer->therapist->username }}?ref={{ $referrer->unique_reff }}"
								@elseif ($referrer->patient()->exists())
									data-clipboard-text="{{ config('app.url') }}referrer/{{ $referrer->unique_reff }}"
								@else
									data-clipboard-text=""
								@endif
							>
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
									<g id="copy" transform="translate(-3 -3)" opacity="0.5">
										<path id="Path_619" data-name="Path 619" d="M18,21H12a3,3,0,0,1-3-3V12a3,3,0,0,1,3-3h6a3,3,0,0,1,3,3v6A3,3,0,0,1,18,21ZM12,11a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V12a1,1,0,0,0-1-1Z" fill="#777"/>
										<path id="Path_620" data-name="Path 620" d="M9.73,15H5.67A2.68,2.68,0,0,1,3,12.33V5.67A2.68,2.68,0,0,1,5.67,3h6.66A2.68,2.68,0,0,1,15,5.67V9.4H13V5.67A.67.67,0,0,0,12.33,5H5.67A.67.67,0,0,0,5,5.67v6.66a.67.67,0,0,0,.67.67H9.73Z" fill="#777"/>
									</g>
								</svg>
							</button>
						</div>
					</div>
					<div class="tbr_block_info">
						<div>Email</div>
						<div>{{ !$referrer->patient_id ? $referrer->therapist->email : $referrer->patient->email }}</div>
					</div>
					<div class="tbr_block_info">
						<div>Mendaftar pada</div>
						<div>{{ formatDate($referrer->created_at, 'd M Y \j\a\m H.i') }}</div>
					</div>
					<div class="mt-3">
						<button
							type="button"
							anim="ripple"
							id="delete-referrer"
							class="btn tbr_btn tbr_btn-light tbr_btn-square"
							data-id="{{ $referrer->id }}"
							data-url="{{ route('referrer.destroy', $referrer->id) }}">
							<img src="{{ asset('assets/svg/icon_trash.svg') }}" alt="Delete">
						</button>
					</div>
				</div>
			</div>
			<div class="card mt-0 mb-4">
				<div class="card-body px-4 py-3">
					<div class="tbr_block_info py-2">
						<div>Sumber Informasi</div>
						<div>{{ !$referrer->patient_id ? $referrer->therapist->source : $referrer->patient->source }}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="tabs tbr_tabs mt-0 mb-4 mb-lg-0">
				<ul class="nav nav-tabs" id="tbr_system_tab" role="tablist">
					<li class="nav-item active">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<g id="Layer_2" data-name="Layer 2" opacity="0.5">
									<g id="person">
										<rect id="Rectangle_1776" data-name="Rectangle 1776" width="24" height="24" fill="#777" opacity="0"/>
										<path id="Path_708" data-name="Path 708" d="M12,11A4,4,0,1,0,8,7,4,4,0,0,0,12,11Zm0-6a2,2,0,1,1-2,2A2,2,0,0,1,12,5Z" fill="#777"/>
										<path id="Path_709" data-name="Path 709" d="M12,13a7,7,0,0,0-7,7,1,1,0,0,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,7,7,0,0,0-7-7Z" fill="#777"/>
									</g>
								</g>
							</svg>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
								<g id="Layer_2" data-name="Layer 2" opacity="0.5">
									<g id="credit-card">
										<rect id="Rectangle_1781" data-name="Rectangle 1781" width="24" height="24" fill="#777" opacity="0"/>
										<path id="Path_712" data-name="Path 712" d="M19,5H5A3,3,0,0,0,2,8v8a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V8A3,3,0,0,0,19,5ZM4,8A1,1,0,0,1,5,7H19a1,1,0,0,1,1,1V9H4Zm16,8a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V11H20Z" fill="#777"/>
										<path id="Path_713" data-name="Path 713" d="M7,15h4a1,1,0,0,0,0-2H7a1,1,0,0,0,0,2Z" fill="#777"/>
										<path id="Path_714" data-name="Path 714" d="M15,15h2a1,1,0,0,0,0-2H15a1,1,0,0,0,0,2Z" fill="#777"/>
									</g>
								</g>
							</svg>
						</a>
					</li>
				</ul>
				<div class="tab-content pb-3">
					<div class="tab-pane active show" id="profile" role="tabpanel">
						<p class="tbr_weight-semi-bold mb-2">Data Personal Referrer</p>
						<div class="tbr_block_info">
							<div>Nama Lengkap</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->name : $referrer->patient->name }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Provinsi</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->province->name : $referrer->patient->province->name }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Kabupaten</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->regency->name : $referrer->patient->regency->name }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Kecamatan</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->district->name : $referrer->patient->district->name }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Kelurahan</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->village : $referrer->patient->village }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Detail Alamat</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->address : $referrer->patient->address }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Alamat Asal</div>
							<div>{{ !$referrer->patient_id ? $referrer->therapist->address_origin : $referrer->patient->address_origin }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Nama Usaha</div>
							<div>{{ $referrer->business_name }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Alamat Usaha</div>
							<div>{{ $referrer->business_address }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Komunitas Bisnis</div>
							<div>{{ $referrer->business_community }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Nomor Telepon</div>
							<div>62 {{ !$referrer->patient_id ? $referrer->therapist->phone : $referrer->patient->phone_number }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Nomor WhatsApp</div>
							<div>62 {{ !$referrer->patient_id ? $referrer->therapist->whatsapp : $referrer->patient->whatsapp_number }}</div>
						</div>
					</div>
					<div class="tab-pane" id="bank" role="tabpanel">
						<p class="tbr_weight-semi-bold mb-2">Nomor Rekening</p>
						<div class="tbr_block_info">
							<div>Nama Bank</div>
							<div>{{ $referrer->bank_name }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Atas Nama</div>
							<div>{{ $referrer->bank_account }}</div>
						</div>
						<div class="tbr_block_info">
							<div>Nomor Rekening</div>
							<div>{{ $referrer->account_number }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card mt-0 mb-o">
				<div class="card-body padding-order p-4">
					<p class="card-label mb-2">Status</p>
					<p class="help-block">Sesuaikan status program referral untuk referrer ini.</p>
					<form action="{{ route('referrer.update', $referrer->id) }}" method="POST" class="main_form">
						@csrf
						@method('PUT')
						<div class="radio-custom radio-primary">
							<input type="radio" id="active" name="referrer_status" value="0" {{ $referrer->blocked == '0' ? 'checked' : '' }}>
							<label class="tbr_weight_semibold" for="active">Active</label>
						</div>
						<div class="radio-custom radio-primary">
							<input type="radio" id="deactive" name="referrer_status" value="1" {{ $referrer->blocked == '1' ? 'checked' : '' }}>
							<label class="tbr_weight_semibold" for="deactive">Deactive</label>
						</div>
						<span class="help-block tbr_label_block">
							<em>Tidak bisa mengakses halaman atau menu program referral.</em>
						</span>
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
		</div>
		@include('admin.include.modal-delete')
	</div>
@endsection
@section('blockfoot')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
	<script src="{{ asset('assets/js/default-ajax.js') }}"></script>
	<script src="{{ asset('assets/js/admin/referrer-delete.js') }}"></script>
	<script>
		$("#delete-referrer").on("click", function(event) {
			deleteData(event, $(this).data("id"), $(this).data("url"));
		})
	</script>
	<script>
		$('.copy').tooltip({
			trigger: 'click',
			placement: 'right'
		});
		function setTooltip(btn, message) {
			$(btn).tooltip('hide')
				.attr('data-original-title', message)
				.tooltip('show');
			}
			function hideTooltip(btn) {
			setTimeout(function() {
				$(btn).tooltip('hide');
			}, 1000);
		}
		var clipboard = new ClipboardJS('.copy');
		clipboard.on('success', function(e) {
			setTooltip(e.trigger, 'Copied!');
			hideTooltip(e.trigger);
		});
		clipboard.on('error', function(e) {
			setTooltip(e.trigger, 'Failed!');
			hideTooltip(e.trigger);
		});
	</script>
	<script>
		$('.tbr_referrer').addClass('nav-expanded nav-active');
	</script>
@endsection