@extends('visitor.layouts.app')
@section('title', 'Konfirmasi')
@section('openMemberAside')
    <div class="container-fluid tbr_open_member_aside" anim="ripple">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            Navigasi Menu
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>
@endsection
@section('content')
    <div class="container">
        <div class="tbr_member_area">
            @include('visitor.layouts.patient-aside')
            <div class="tbr_member_content_body">
                <div class="tbr_page_title mb-4">
                    <h4 class="tbr_weight-bold tbr_text-primary mb-1">Program Referral</h4>
                    <p class="mb-0">Dapatkan banyak keuntungan rupiah dengan mereferensikan teman Anda.</p>
                </div>
                <div class="mb-4 py-2">
                    <h4 class="tbr_weight-bold tbr_text-primary mb-3">Rekomendasikan haloterapi dan dapatkan banyak keuntungan</h4>
                    <p class="mb-0">
                        Program afiliasi haloterapi terbuka untuk Anda yang ingin mendapatkan penghasilan tambahan yang tidak
                        terbatas dari internet dengan mudah. Setiap pelanggan haloterapi yang telah terdaftar juga bisa langsung
                        bergabung dalam program referral, karena program referral ini gratis dan tidak dipungut biaya. Anda akan
                        mendapatkan komisi hanya dengan merekomendasikan layanan haloterapi melalui link referral.
                    </p>
                </div>
                <div class="text-center">
                    <p>Ayo aktifkan akun referral haloterapi Anda sekarang. Gratis lho!</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('patient.referral.form') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary">Aktifkan akun referral sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('blockfoot')
    <script>
        $('.tbr_member_nav_referral').addClass('tbr_nav_active');
    </script>
@endsection