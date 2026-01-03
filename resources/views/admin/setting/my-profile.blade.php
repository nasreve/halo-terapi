@extends('admin.layouts.app')
@section('title', 'Profil Saya')
@section('blockhead')
@endsection
@section('content')
	<header class="page-header">
		<h2>Profil Saya</h2>
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
					<span>Profil Saya</span>
				</li>
			</ol>
		</div>
	</header>
	<div class="row justify-content-center">
		<div class="col-xl-8">
			<div class="card">
				<div class="card-body">
					<form action="{{ route('my-profile.update') }}" method="POST" class="main_form" autocomplete="off">
						@csrf
						<div class="form-group row">
							<label class="col-lg-4 control-label text-lg-right mb-0" for="name">
								Nama Anda
								<span class="help-block">required</span>
							</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
							</div>
						</div>
						<div class="my-4">
							<h4 class="tbr_form_title mb-0">Akun Anda</h4>
							<p class="help-block m-0">
								Anda dapat mengubah data akun berupa email dan password.
							</p>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 control-label text-lg-right mb-0" for="email">
								Alamat Email
								<span class="help-block">required</span>
							</label>
							<div class="col-lg-8">
								<input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-4 control-label text-lg-right mb-0" for="password">
								Password
								<span class="help-block">optional</span>
							</label>
							<div class="col-lg-8">
								<input type="password" class="form-control" id="password" name="password">
								<small class="help-block mb-0">
									Kosongkan jika tidak ingin mengganti password.
								</small>
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-lg-4 control-label text-lg-right mb-0" for="password_confirmation">
								Konfirmasi Password
								<span class="help-block">optional</span>
							</label>
							<div class="col-lg-8">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
								<small class="help-block mb-0">
									Kosongkan jika tidak ingin mengganti password.
								</small>
							</div>
						</div>
						<div class="form-group d-flex justify-content-end pt-3">
							<a href="{{ url()->previous() }}" type="button" class="btn tbr_btn tbr_btn-light mr-2">
								Kembali
							</a>
							<button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary">
								Simpan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('blockfoot')
	<script src="{{ asset('assets/js/default-ajax.js') }}">
	</script>
	<script>
		$('.tbr_setting').addClass('nav-active');
		$('.tbr_setting').addClass('nav-expanded');
		$('.tbr_setting_myprofile').addClass('nav-active');
	</script>
@endsection