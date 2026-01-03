@extends('visitor.layouts.app')
@section('title', 'Dashboard Referral')
@section('blockhead')
    <link rel="stylesheet" href="{{ asset('porto/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
@endsection
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
            @include('visitor.layouts.therapist-aside')
            <div class="tbr_member_content_body">

                {{-- Jika referral-nya di deactivekan oleh admin bro... --}}
                @if ($therapist->referrer->blocked)
                    <div class="alert alert-danger d-flex align-items-center justify-content-between mb-4" role="alert">
                        <div class="d-flex align-items-center justify-content-between">
                            <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_exclamation_danger.svg') }}" alt="Success">
                            <span>Program referral Anda telah dideactivekan oleh admin karena kesalahan atau suatu hal. Jika ada pertanyaan silakan menghubungi admin Haloterapi.</span>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g id="Layer_2" data-name="Layer 2" opacity="0.5">
                                    <g id="close">
                                        <rect id="Rectangle_1493" data-name="Rectangle 1493" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#fff" opacity="0"/>
                                        <path id="Path_553" data-name="Path 553" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#fff"/>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                @endif

                {{-- Jika telah menyelesaikan pendaftaran sebagai referrer --}}
                @if (session('register_status') === 'success')
                <div class="alert alert-primary d-flex align-items-center justify-content-between mb-4" role="alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <img class="mr-3" src="{{ asset('/assets/svg/icons/icon_check_circle_success.svg') }}" alt="Success">
                        <span>Anda berhasil melakukan pendaftaran sebagai referrer. Di halaman inilah yang nantinya sebagai dashboard referral Anda.</span>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Layer_2" data-name="Layer 2" opacity="0.5">
                                <g id="close">
                                    <rect id="Rectangle_1493" data-name="Rectangle 1493" width="24" height="24" transform="translate(24 24) rotate(180)" fill="#fff" opacity="0"/>
                                    <path id="Path_553" data-name="Path 553" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" fill="#fff"/>
                                </g>
                            </g>
                        </svg>
                    </button>
                </div>
                @endif

                <div class="tbr_page_title mb-3 mb-md-4">
                    <h4 class="tbr_weight-bold tbr_text-primary mb-0">Program Referral</h4>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="tbr_small_title mb-2">Profil Anda</div>
                        <div class="tbr_inline_content">
                            <dl class="row">
                                <dt class="col-sm-3">Nama</dt>
                                <dd class="col-sm-9"><em>{{ $therapist->name }}</em></dd>

                                <dt class="col-sm-3">Telepon</dt>
                                <dd class="col-sm-9"><em>62 {{ $therapist->phone }}</em></dd>

                                <dt class="col-sm-3">WhatsApp</dt>
                                <dd class="col-sm-9"><em>62 {{ $therapist->whatsapp }}</em></dd>

                                <dt class="col-sm-3">Email</dt>
                                <dd class="col-sm-9"><em>{{ $therapist->email }}</em></dd>

                                <dt class="col-sm-3">Alamat</dt>
                                <dd class="col-sm-9"><em>{{ $therapist->full_address }}</em></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tbr_small_title mb-2">Nomor Rekening</div>
                        <form action="{{ route('therapist.referral.updateAccount') }}" method="POST" class="main_form">
                            @csrf
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="bank_name"
                                    name="bank_name"
                                    value="{{ $therapist->referrer->bank_name }}"
                                    placeholder="Nama Bank"
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="bank_account"
                                    name="bank_account"
                                    value="{{ $therapist->referrer->bank_account }}"
                                    placeholder="Atas Nama"
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="account_number"
                                    name="account_number"
                                    value="{{ $therapist->referrer->account_number }}"
                                    placeholder="Nomor Rekening"
                                    tabindex=""
                                    spellcheck="false"
                                >
                                <div class="invalid-feedback" role="alert"></div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-primary d-inline-flex">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tbr_page_title mb-3 pb-1 pt-2">
                    <div class="tbr_small_title mb-1">Referral Link</div>
                    <p class="mb-0">Anda akan memperoleh fee setiap ada pesanan ke haloterapi melalui link berikut :</p>
                </div>
                <div class="row mb-4 pt-0">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                        <div class="form-group">
                            <label for="url" class="mb-1 tbr_text-grey">
                                <em>Pemesanan melalui halaman profil Anda</em>
                            </label>
                            <div class="input-group tbr_ig-btn">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="url"
                                    name="url"
                                    value="{{ route('therapist.profile', ['username' => $therapist->username, 'ref' => $therapist->referrer->unique_reff]) }}"
                                    placeholder=""
                                    tabindex=""
                                    disabled
                                >
                                <div class="input-group-append">
                                    <button
                                        type="button"
                                        anim="ripple"
                                        class="btn tbr_btn tbr_btn-success d-inline-block copy"
                                        data-clipboard-text="{{ route('therapist.profile', ['username' => $therapist->username, 'ref' => $therapist->referrer->unique_reff]) }}"
                                    >
                                        <img src="{{ asset('assets/svg/icons/icon_copy.svg') }}" alt="Copy">
                                        Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="mb-1 tbr_text-grey">
                                <em>Pemesanan melalui halaman landing</em>
                            </label>
                            <div class="input-group tbr_ig-btn">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="url"
                                    name="url"
                                    value="{{ route('referrer.code', $therapist->referrer->unique_reff) }}"
                                    placeholder=""
                                    tabindex=""
                                    disabled
                                >
                                <div class="input-group-append">
                                    <button
                                        type="button"
                                        anim="ripple"
                                        class="btn tbr_btn tbr_btn-success d-inline-block copy"
                                        data-clipboard-text="{{ route('referrer.code', $therapist->referrer->unique_reff) }}"
                                    >
                                        <img src="{{ asset('assets/svg/icons/icon_copy.svg') }}" alt="Copy">
                                        Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4 pt-2 mb-md-0">
                    <div class="col-md-5">
                        <div class="tbr_page_title">
                            <div class="tbr_small_title mb-1">Data Transaksi</div>
                            <p>Perolehan komisi Anda.</p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="tbr_datepicker_filter">
                            <div class="input-daterange input-group tbr_fix_ig datepicker">
                                <span class="input-group-prepend">
                                    <img src="{{ asset('/assets/svg/icons/icon_calendar.svg') }}" alt="Calendar">
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="start"
                                    id="dateStart"
                                    placeholder="00-00-0000"
                                    autocomplete="off"
                                >
                                <span class="input-group-text border-left-0 border-right-0 rounded-0">
                                    to
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="end"
                                    id="dateEnd"
                                    placeholder="00-00-0000"
                                    autocomplete="off"
                                >
                            </div>
                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-success btn-filter">
                                <img class="mr-2" src="{{ asset('/assets/svg/icon_filter.svg') }}" alt="Filter">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-md-8">
                        <div class="text-center text-md-left">
                            <div class="tbr_block_amount mb-0">
                                <span>Rp</span>
                                <span id="total-referrer-fee">0</span>
                                <span id="total-transaction">dari 0 transaksi</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-right d-none d-md-block">
                            <button type="button" onclick="reset(event)" anim="ripple" class="btn tbr_btn tbr_btn-light tbr_btn-square m-auto ml-md-auto mr-md-0">
                                <img src="{{ asset('/assets/svg/icon_reset_2.svg') }}" alt="Reset">
                            </button>
                        </div>
                    </div>
                </div>

                <table class="table tbr_table tbr_table_referrer" style="min-width: 1100px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="width: 15%">Tanggal</th>
                            <th>Layanan</th>
                            <th>Pasien</th>
                            <th>Terapis</th>
                            <th>Tarif</th>
                            <th>Pelaksanaan</th>
                            <th>Komisi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('sticky-toolbar')
    <ul class="tbr_sticky_toolbar d-block d-md-none">
        <li class="tbr_sticky_toolbar_item tbr_reset">
            <a href="" class="tbr_sticky_toolbar-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="Layer_2" data-name="Layer 2" opacity="0.5">
                        <g id="refresh">
                            <rect id="Rectangle_1152" data-name="Rectangle 1152" width="24" height="24" fill="#8a949b" opacity="0"/>
                            <path id="Path_304" data-name="Path 304" d="M3.742,13.43a1,1,0,0,1,1.252.65A7.151,7.151,0,0,0,11.876,19a7.106,7.106,0,0,0,7.192-7,7.106,7.106,0,0,0-7.192-7A7.279,7.279,0,0,0,7.218,6.67l2.174-.36a1,1,0,1,1,.321,1.98l-4.247.7h-.17a1,1,0,0,1-.341-.06.331.331,0,0,1-.1-.06.782.782,0,0,1-.2-.11l-.09-.11c0-.05-.09-.09-.13-.15s0-.1-.05-.14a1.339,1.339,0,0,1-.07-.18l-.751-4a1.019,1.019,0,0,1,2-.38l.27,1.45A9.234,9.234,0,0,1,11.876,3a9.108,9.108,0,0,1,9.195,9,9.108,9.108,0,0,1-9.195,9,9.134,9.134,0,0,1-8.834-6.32,1,1,0,0,1,.7-1.25Z" transform="translate(-0.036)" fill="#8a949b"/>
                        </g>
                    </g>
                </svg>
            </a>
        </li>
    </ul>
@endsection
@section('blockfoot')
    <script src="{{ asset('porto/vendor/luxon/luxon.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/patient/update-setting.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script src="{{ asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('porto/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/datatable-with-select2.js') }}"></script>
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
    <script src="{{ asset('assets/js/visitor/default-datatable.js') }}"></script>
    <script>
        const referralUrl = "{{ route('therapist.referral.dashboard') }}";
        const url = "{{ route('therapist.referral.list') }}";
        const orderFalse = [];

        let orderDatatable;
        $(function() {
            orderDatatable = initDatatables(url, orderFalse, initTooltip);

            orderDatatable.on('search.dt', function () {
				let datas = orderDatatable.rows( { filter : 'applied'} ).data();
				let dataLength = orderDatatable.rows( { filter : 'applied' } ).nodes().length;
				let total = 0;
				let done = false;

                for (const property in datas) {
                    if ((property < dataLength) && (datas[property][6]?.replace(/<\/?[^>]+(>|$)/g, "") == "Berhasil")) {
                        total += parseInt(datas[property][7]?.replace(/[^0-9\-]+/g,""));
                    } else {
                        done = true;
                    }
                }

                if (done) {
                    console.log(total);
                    const formattedTotal = new Intl.NumberFormat('id-ID').format(total);
                    $("#total-referrer-fee").html(formattedTotal);
                    $("#total-transaction").html(
                        `dari ${dataLength} transaksi`
                    );
                }
			});
        });

        function initTooltip() {
			$(function () {
				$('[data-toggle="tooltip"]').tooltip({
					trigger : 'hover'
				});
			});
		}

        $('.tbr_member_nav_referral').addClass('tbr_nav_active');
    </script>
    <script src="{{ asset('assets/js/visitor/patient/referrer-filter.js') }}"></script>
@endsection