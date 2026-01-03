@extends('visitor.layouts.app')
@section('title', 'Laporan')
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
        <div class="tbr_member_area tbr_sm_aside">
            @include('visitor.layouts.therapist-aside')
            <div class="tbr_member_content_body">
                <div class="row align-items-center no-gutters mb-4 pb-0">
                    <div class="col-lg-4">
                        <div class="tbr_page_title mb-3 mb-lg-0">
                            <h4 class="tbr_weight-bold tbr_text-primary mb-1">Pendapatan Terapis</h4>
                            <p class="mb-0">{{ $therapist->name }}</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tbr_report_filter">
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
                            <div class="form-group mb-0">
                                <select
                                    class="form-control"
                                    id="payment-method"
                                    name="payment-method"
                                    placeholder=""
                                    tabindex=""
                                >
                                    <option value="" title="Select">Pembayaran</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                            <button type="submit" anim="ripple" class="btn tbr_btn tbr_btn-success btn-filter">
                                <img class="mr-2" src="{{ asset('/assets/svg/icon_filter.svg') }}" alt="Filter">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="tbr_block_amount mb-4 mb-lg-2">
                        <span>Rp</span>
                        <span id="total-therapist-fee">{{ formatNumberTwoComas($total_therapist_fee) }}</span>
                        <span id="total-transaction">dari {{ $orders->count() }} transaksi</span>
                    </div>
                </div>

                <table class="table tbr_table tbr_table_report" style="min-width: 1200px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th style="width: 13%">ID Pesanan</th>
                            <th>Pasien</th>
                            <th style="width: 13%">Layanan</th>
                            <th>Pembayaran</th>
                            <th>Tarif</th>
                            <th style="width: 15%">Fee Ven/Ref</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('sticky-toolbar')
    <ul class="tbr_sticky_toolbar">
        <li class="tbr_sticky_toolbar_item tbr_reset">
            <a href="" onclick="reset(event)" class="tbr_sticky_toolbar-success">
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
        <li class="tbr_sticky_toolbar_item">
            <a href="{{ url()->previous() }}" class="tbr_sticky_toolbar-orange">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="Layer_2" data-name="Layer 2" opacity="0.5">
                        <g id="arrow-back">
                            <rect id="Rectangle_1737" data-name="Rectangle 1737" width="24" height="24" transform="translate(24) rotate(90)" fill="#8a949b" opacity="0"/>
                            <path id="Path_690" data-name="Path 690" d="M19,11H7.14l3.63-4.36A1,1,0,0,0,9.23,5.36l-5,6a1.19,1.19,0,0,0-.09.15.127.127,0,0,1-.07.13.961.961,0,0,0,0,.72.127.127,0,0,0,.07.13,1.19,1.19,0,0,0,.09.15l5,6a1,1,0,1,0,1.54-1.28L7.14,13H19a1,1,0,0,0,0-2Z" fill="#8a949b"/>
                        </g>
                    </g>
                </svg>
            </a>
        </li>
    </ul>
@endsection
@section('blockfoot')
    <script src="{{ asset('porto/vendor/luxon/luxon.js') }}"></script>
    <script src="{{ asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('porto/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/datatable-with-select2.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/default-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/visitor/therapist/report-filter.js') }}"></script>
    <script>
        const therapistlUrl = "{{ route('therapist.report') }}";
        const url = "{{ route('therapist.report.list') }}";
        const orderFalse = [];

        let orderDatatable;
        $(function() {
            orderDatatable = initDatatables(url, orderFalse, initTooltip);

            orderDatatable.on( 'search.dt', function () {
				let datas = orderDatatable.rows( { filter : 'applied'} ).data();
				let dataLength = orderDatatable.rows( { filter : 'applied'} ).nodes().length;
				let total = 0;
				let done = false;

                for (const property in datas) {
                    if (property < dataLength) {
                        total += parseInt(datas[property][8]?.replace(/[^0-9\-]+/g,""));
                    } else {
                        done = true;
                    }
                }

                if (done) {
                    const formattedTotal = new Intl.NumberFormat('id-ID').format(total);
                    $("#total-therapist-fee").html(formattedTotal);
                    $("#total-transaction").html(
                        `dari ${dataLength} transaksi`
                    );
                }
			} );
        });

        function initTooltip() {
			$(function () {
				$('[data-toggle="tooltip"]').tooltip({
					trigger : 'hover'
				});
			});
		}

        // Inisialisasi select2
        $('select').select2();

        // Active class sidebar
        $('.tbr_member_nav_report').addClass('tbr_nav_active');
    </script>
@endsection