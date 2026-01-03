<!doctype html>
<html>
	<head>
		<title>INVOICE - {{ $order->order_id }}</title>
		<meta charset="UTF-8">
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="google-site-verification" content="" />
        <meta name="msvalidate.01" content="" />
        <meta name="robots" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="shortcut icon" href="{{ asset('Favicon.png') }}" type="image/x-icon" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap">
        <link rel="stylesheet" href="{{ public_path('/porto/vendor/bootstrap/css/bootstrap-3.4.1.min.css') }}" />
        <style rel="stylesheet">
            @page                       { size: auto; margin: 0mm 0mm 0mm 0mm; }
            body                        { font-family: 'Source Sans Pro', sans-serif; line-height: 15px; font-size: 14px; color: #444444; margin-top: 2cm; }
            .h1                         { font-size: 36px; font-weight: 700; }
            .h2                         { font-size: 32px; font-weight: 700; }
            .h3                         { font-size: 28px; font-weight: 700; }
            .h4                         { font-size: 24px; font-weight: 700; }
            .h5                         { font-size: 20px; font-weight: 700; }
            .h6                         { font-size: 16px; font-weight: 700; }
            .p-0                        { padding: 0 !important; }
            .pr-1                       { padding-right: 10px !important; }
            .pr-2                       { padding-right: 20px !important; }
            .m-0                        { margin: 0 !important; }
            .mb-1                       { margin-bottom: 10px !important; }
            .mb-2                       { margin-bottom: 20px !important; }
            .mb-3                       { margin-bottom: 30px !important; }
            .mb-4                       { margin-bottom: 40px !important; }
            .float-left                 { float: left !important; }
            .float-right                { float: right !important; }
            .clearfix                   { display: block; clear: both; content: ""; }
            .text-default               { color: #8A949B !important; }
            .text-danger                { color: #E91D62 !important; }
            .text-orange                { color: #FF6A00 !important; }
            .text-primary               { color: #2970FA !important; }
            .text-purple                { color: #7A69E6 !important; }
            .text-success               { color: #47A447 !important; }
            .help-block                 { color: #777777 !important; }
            .text-center                { text-align: center; }
            .text-right                 { text-align: right; }
            .text-left                  { text-align: left; }
            .invoice-watermark          { position: fixed; top: 0; left: 0; bottom: 0; width: 100px; height: 100%; min-height: 1050px; }
            .invoice-header             { padding: 0 70px 20px 100px; margin-top: -10px ;margin-bottom: 10px; }
            .invoice-body               { padding: 0 0 20px 100px; }
            .invoice-summary            { margin: -15px 0 10px 0; }
            .invoice-summary-content    { max-width: 250px; }
            .invoice-item               { padding: 20px 0 0 0; }
            .invoice-item .help-block   { margin: 4px 0 4px 0; }
            .invoice-title              { margin: 0 0 -10px 0; font-size: 18px; letter-spacing: 2px; }
            .invoice-code               { margin: 0 0 14px 0; }
            .invoice-to                 { padding-left: 40px; padding-right: 10px; }
            .invoice-id                 { margin-bottom: 4px; }
            .invoice-address            { padding-right: 8px; }
            .invoice-brand              { font-size: 16px; }
            .invoice-wrap               { min-width: 730px; min-height: 987px; padding: 0 40px 60px; }
            .company-info .h6           { margin: 6px 0 6px 0; }
            .table-style                { margin-bottom: 20px; border-radius: 10px; overflow: hidden; border: 2px solid #F4F7F0; background-color: #F4F7F0; }
            table                       { width: 100%; margin-bottom: 0; }
            table thead tr              { background-color: #F4F7F0 !important; }
            table tbody tr              { background-color: #FFFFFF !important; }
            table tr:first-child,
            table tr:first-child th     { border-bottom: none; }
            table tr th                 { background-color: #F4F7F0 !important; font-weight: normal; -webkit-print-color-adjust: exact; padding: 12px 20px; border-bottom: none !important; }
            table tr td                 { padding: 12px 20px; border-top: 2px solid #F4F7F0 !important; border-right: none !important; border-bottom: none !important; border-left: none !important; }
            #watermark                  { position: fixed; top: 0; bottom: 0; left: 0; width: 100px; height: 1130px; z-index: -1000; }
        </style>
	</head>
	<body>
        <div id="watermark">
            <img src="{{ public_path('/assets/images/invoice-bg.png') }}" height="100%" width="100%" />
        </div>
        <div class="invoice-wrap">
            <div class="invoice-header">
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <img class="mb-1" src="{{ public_path('/assets/images/Invoice-Logo.png') }}" alt="Haloterapi">
                        <p class="p-0 m-0 h6"><strong>Haloterapi</strong></p>
                        <p class="p-0 m-0">Telepon : 62 81393108310</p>
                    </div>
                    <div class="col-xs-6">
                        <div class="text-right invoice-address">
                            Grembyang RT 15 RW 08, Kelurahan<br>
                            Karangwungu, Kecamatan Karangdowo<br>
                            Kabupaten Klaten, Provinsi<br>
                            Jawa Tengah 57464
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-body">
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <p class="invoice-title">INVOICE</p>
                        <p class="h5 invoice-id">{{ $order->order_id }}</p>
                        <p class="m-0">Tanggal Pemesanan : {{ formatDate($order->created_at, 'd F Y \j\a\m H.i') }}</p>
                        @if ($order->payment_status === "Sudah Dibayar")
                        <p class="m-0 text-default">Status : <strong><span class="text-success">Sudah Dibayar</span></strong></p>
                        @else
                        <p class="m-0">Status : <strong><span class="text-danger">Belum Dibayar</span></strong></p>
                        @endif
                    </div>
                    <div class="col-xs-6">
                        <div class="invoice-to">
                            <p class="m-0"><em>Kepada :</em></p>
                            <p class="m-0"><strong>{{ $order->buyer_name }}</strong></p>
                            <p class="m-0">Telpon : 62 {{ $order->buyer_phone }}</p>
                            <p class="m-0">WhatsApp : 62 {{ $order->buyer_whatsapp }}</p>
                            <p class="m-0">Email : {{ $order->buyer_email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="invoice-body" style="padding-right: 18px !important;">
                <p class="mb-1">Item Pemesanan :</p>
                <div class="table-style">
                    <table>
                        <thead>
                            <tr>
                                <th width="50%">Item</th>
                                <th width="25%" class="text-right">Biaya Layanan</th>
                                <th width="25%" class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td>
                                        <p class="m-0">{{ $orderItem->service }}</p>
                                        <p class="m-0"><em>{{ $order->therapist->name }}</em></p>
                                    </td>
                                    <td class="text-right">{{ formatPrice($orderItem->rate) }}</td>
                                    <td class="text-right">{{ formatPrice($orderItem->rate) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row clearfix mb-3">
                    <div class="col-xs-12">
                        <div class="text-center">
                            <p class="m-0">Total yang harus dibayar adalah :</p>
                            <p class="m-0 h4 text-danger">{{ formatPrice($order->transaction_amount) }}</p>
                        </div>
                    </div>
                </div>

                @if ($order->buyer_payment_method === "Cash")
                    {{-- Pembayaran Cash --}}
                    <div class="row clearfix mb-2">
                        <div class="col-xs-12">
                            <div class="text-left mb-1">
                                <p class="m-0"><strong>Metode Pembayaran :</strong></p>
                                <p class="m-0">Cash (Pembayaran Langsung)</p>
                            </div>
                            <div class="text-left">
                                <p class="m-0"><strong>Catatan :</strong></p>
                                <p class="m-0">Silakan bayar sesuai dengan nominal di atas secara langsung kepada terapis</p>
                                <p>{{ $order->therapist->name }}.</p>
                                <p class="m-0">Jika ada pertanyaan terkait invoice ini, silakan hubungi 62 81393108310.</p>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Pembayaran Transfer --}}
                    <div class="row clearfix mb-2">
                        <div class="col-xs-12">
                            <div class="text-left mb-1">
                                <p class="m-0"><strong>Pembayaran dapat di transfer melalui :</strong></p>
                                <p class="m-0">{{ $setting->bank_name }} Nomor Rekening {{ $setting->account_number }} a.n. {{ $setting->bank_account }}</p>
                            </div>
                            <div class="text-left">
                                <p class="m-0"><strong>Catatan :</strong></p>
                                <p class="m-0">Pastikan nilai total tagihan Anda sudah benar kepada Haloterapi.</p>
                                <p class="m-0">Jika ada pertanyaan terkait invoice ini, silakan hubungi 62 81393108310.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
