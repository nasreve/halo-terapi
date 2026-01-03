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
        <link rel="stylesheet" href="{{ asset('/porto/vendor/bootstrap/css/bootstrap-3.4.1.min.css') }}" />
        <style rel="stylesheet">
            @page                       { size: auto; margin: 0mm 0mm 0mm 0mm; padding: 100px 0; }
            body                        { font-family: 'Source Sans Pro', sans-serif; line-height: 21px; font-size: 14px; font-weight: normal; color: #999999; background-color: #EEEEEE; }
            .invoice-watermark          { position: absolute; top: 0; bottom: 0; right: auto; left: -2px; width: 100px; height: 100%; min-height: 100%; background-color: #47A447; }
            .invoice-watermark img      { width: 100px; height: 100%; min-height: auto;  }
            .h1                         { font-size: 36px; font-weight: 700; }
            .h2                         { font-size: 32px; font-weight: 700; }
            .h3                         { font-size: 28px; font-weight: 700; }
            .h4                         { font-size: 24px; font-weight: 700; }
            .h5                         { font-size: 20px; font-weight: 700; }
            .h6                         { font-size: 16px; font-weight: 700; }
            .p-0                        { padding: 0 !important; }
            .m-0                        { margin: 0 !important; }
            .mb-1                       { margin-bottom: 10px !important; }
            .mb-2                       { margin-bottom: 20px !important; }
            .mb-3                       { margin-bottom: 30px !important; }
            .float-left                 { float: left !important; }
            .float-right                { float: right !important; }
            .invoice-header             { padding: 30px 5px 20px 100px; margin-bottom: 16px; }
            .invoice-body               { padding: 0 0 20px 100px; }
            .invoice-header img         { margin-right: 20px; }
            .clearfix                   { display: block; clear: both; content: ""; }
            .text-default, strong, em   { color: #444444 !important; }
            .text-danger                { color: #E91D62 !important; }
            .text-orange                { color: #FF6A00 !important; }
            .text-primary               { color: #2970FA !important; }
            .text-purple                { color: #7A69E6 !important; }
            .text-success               { color: #47A447 !important; }
            .help-block                 { color: #777777 !important; }
            .text-center                { text-align: center; }
            .text-right                 { text-align: right; }
            .text-left                  { text-align: left; }
            .invoice-summary            { margin: -15px 0 10px 0; }
            .invoice-summary-content    { max-width: 250px; }
            .invoice-item               { padding: 20px 0 0 0; }
            .invoice-item .help-block   { margin: 4px 0 4px 0; }
            .invoice-title              { margin: 0 0 8px 0; }
            .invoice-code               { margin: 0 0 14px 0; }
            .invoice-wrap               { max-width: 800px; background-color: #FFFFFF; padding: 40px 40px 80px 40px; position: relative; overflow: hidden; }
            .company-info .h6           { margin: 6px 0 6px 0; }
            @media print {
                body                    { color: #999999; }
                .table-style            { margin-bottom: 0; border-radius: 10px; overflow: hidden; border: 2px solid #F4F7F0; background-color: #F4F7F0; }
                table                   { width: 100%; margin-bottom: 0; }
                table tr:first-child,
                table tr:first-child th { border-bottom: none; }
                table tr th             { background-color: #F4F7F0 !important; font-weight: normal; -webkit-print-color-adjust: exact; padding: 12px 20px; border-bottom: none !important; }
                table tr th:first-child { border-radius: 5px 0 0 0 !important; }
                table tr th:last-child  { border-radius: 0 5px 0 0 !important; }
                table tr td             { padding: 12px 20px; border: none !important; }
                table tr td             { border-top: 2px solid #F4F7F0 !important; }
            }
            #watermark                  { position: fixed; top: 0; bottom: 0; left: 0; width: 100px; height: 1130px; z-index: -1000; }
        </style>
	</head>
	<body>
        <div id="watermark">
            <img src="{{ asset('/assets/images/invoice-bg.png') }}" height="100%" width="100%" />
        </div>
        <div class="container invoice-wrap">
            <div class="invoice-header">
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <div class="company-info">
                            <img class="mb-1" src="{{ asset('/assets/svg/etc/Invoice-Logo.svg') }}" alt="Invoice">
                            <p class="p-0 m-0 text-default" style="font-size: 16px;"><strong>Haloterapi</strong></p>
                            <p class="p-0 m-0 text-default">Telepon : 62 81393108310</p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <p class="p-0 m-0 text-right text-default">
                            Grembyang RT 15 RW 08, Kelurahan<br>
                            Karangwungu, Kecamatan Karangdowo<br>
                            Kabupaten Klaten, Provinsi<br>
                            Jawa Tengah 57464
                        </p>
                    </div>
                </div>
            </div>

            <div class="invoice-body" style="padding-right: 5px;">
                <div class="row clearfix">
                    <div class="col-xs-7">
                        <p class="text-default" style="margin-bottom: -5px; letter-spacing: 2px; font-size: 18px;">INVOICE</p>
                        <p class="h5 text-default">{{ $order->order_id }}</p>
                        <p class="m-0 text-default">Tanggal Pemesanan : {{ formatDate($order->created_at, 'd F Y \j\a\m H.i') }}</p>
                        @if ($order->payment_status === "Sudah Dibayar")
                        <p class="m-0 text-default">Status : <strong><span class="text-success">Sudah Dibayar</span></strong></p>
                        @else
                        <p class="m-0 text-default">Status : <strong><span class="text-danger">Belum Dibayar</span></strong></p>
                        @endif
                    </div>
                    <div class="col-xs-5">
                        <p class="m-0 text-default"><em>Kepada :</em></p>
                        <p class="m-0 text-default"><strong>{{ $order->buyer_name }}</strong></p>
                        <p class="m-0 text-default">Telpon : 62 {{ $order->buyer_phone }}</p>
                        <p class="m-0 text-default">WhatsApp : 62 {{ $order->buyer_whatsapp }}</p>
                        <p class="m-0 text-default">Email : {{ $order->buyer_email }}</p>
                    </div>
                </div>

                <div class="row clearfix mb-2">
                    <div class="col-xs-12">
                        <div class="invoice-item">
                            <p class="help-block mb-1">Item Pemesanan :</p>
                            <div class="table-style">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="50%" class="text-default">Item</th>
                                            <th width="25%" class="text-right text-default">Biaya Layanan</th>
                                            <th width="25%" class="text-right text-default">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $orderItem)
                                            <tr>
                                                <td>
                                                    <p class="m-0 text-default">{{ $orderItem->service }}</p>
                                                    <p class="m-0 text-default"><em>{{ $order->therapist->name }}</em></p>
                                                </td>
                                                <td class="text-right text-default">{{ formatPrice($orderItem->rate) }}</td>
                                                <td class="text-right text-default">{{ formatPrice($orderItem->rate) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-3">
                    <p class="text-default" style="margin-bottom: 7px;">Total yang harus dibayar adalah :</p>
                    <p class="m-0 h4 text-danger">{{ formatPrice($order->transaction_amount) }}</p>
                </div>

                @if ($order->buyer_payment_method === "Cash")
                    {{-- Pembayaran Cash --}}
                    <div class="text-left mb-1">
                        <p class="m-0 text-default"><strong>Metode Pembayaran :</strong></p>
                        <p class="m-0 text-default">Cash (Pembayaran Langsung)</p>
                    </div>
                    <div class="text-left">
                        <p class="m-0 text-default"><strong>Catatan :</strong></p>
                        <p class="m-0 text-default">Silakan bayar sesuai dengan nominal di atas secara langsung kepada terapis {{ $order->therapist->name }}.</p>
                        <p class="m-0 text-default">Jika ada pertanyaan terkait invoice ini, silakan hubungi 62 81393108310.</p>
                    </div>
                @else
                    {{-- Pembayaran Transfer --}}
                    <div class="text-left mb-1">
                        <p class="m-0 text-default"><strong>Pembayaran dapat di transfer melalui :</strong></p>
                        <p class="m-0 text-default">{{ $setting->bank_name }} Nomor Rekening {{ $setting->account_number }} a.n. {{ $setting->bank_account }}</p>
                    </div>
                    <div class="text-left">
                        <p class="m-0 text-default"><strong>Catatan :</strong></p>
                        <p class="m-0 text-default">Pastikan nilai total tagihan Anda sudah benar kepada Haloterapi.</p>
                        <p class="m-0 text-default">Jika ada pertanyaan terkait invoice ini, silakan hubungi 62 81393108310.</p>
                    </div>
                @endif

            </div>
        </div>
        <script>
			window.print();
        </script>
    </body>
</html>
