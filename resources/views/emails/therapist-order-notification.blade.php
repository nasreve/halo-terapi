<style>
    .tbr_text-left      { text-align: left !important; }
    .tbr_text-right     { text-align: right !important; }
    .tbr_text-center    { text-align: center !important; }
    .tbr_display-block  { display: block !important }
    .tbr_text-regular   { font-weight: 400 !important; }
    .tbr_text-medium    { font-weight: 500 !important; }
    .tbr_text-semi-bold { font-weight: 600 !important; }
    .tbr_text-bold      { font-weight: 700 !important; }
    .tbr_text-light     { color: #FFFFFF !important; }
    .tbr_text-dark      { color: #3D4852 !important; }
    .tbr_text-danger    { color: #F8374B !important; }
    .tbr_text-success   { color: #28AF52 !important; }
    .tbr_text-h2        { font-size: 22px !important; }
    .tbr_mb-1           { margin-bottom: 10px !important }
    .tbr_mb-2           { margin-bottom: 20px !important }
    .tbr_mb-3           { margin-bottom: 30px !important }
    .tbr_mb-4           { margin-bottom: 40px !important }
    .tbr_mb-5           { margin-bottom: 50px !important }

    .tbr_fix_height { min-height: 97px; }
    .tbr_table { display: block; width: 100%; border: none; padding: 0; margin: 0; }
    .tbr_table > tbody { display: block; width: 100%; border: none; padding: 0; margin: 0; }
    .tbr_table > tbody > tr { display: block; padding: 0; float: left; border: 1px solid #EFEFEF; }
    .tbr_table > tbody > tr > th { display: block; width: 100%; padding: 0; margin: 0; height: 97px; }

    .tbr_table table { display: block; width: 100%; border: none; }
    .tbr_table table > tbody { display: block; width: 100%; border: none; }
    .tbr_table table > tbody > tr { display: block; width: 100%; border: none; }
    .tbr_table table > tbody > tr > th { display: block; width: 100%; border: none; background-color: #EFEFEF; padding: 8px 12px; font-size: 15px; font-weight: 600; color: #3D4852; text-align: center; }
    .tbr_table table > tbody > tr > td { display: block; width: 100%; border: none; padding: 8px 12px; font-size: 15px; font-weight: normal; text-align: center; min-height: 60px; }

    @media only screen and (max-width: 768px) {
        .tbr_table > tbody > tr { width: 100% !important; float: none; border-right: 1px solid #EFEFEF !important;  }
        .tbr_table > tbody > tr > th { height: initial !important; }
        .tbr_table table > tbody > tr > td { min-height: initial !important; }
    }
</style>

@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('assets/images/Email-Logo.png') }}" alt="{{ config('app.name') }}">
@endcomponent
@endslot

# Hallo, {{ $data->therapist->name }}

Ada pesanan baru untuk Anda. Kami lampirkan data pesanan dengan atas nama <em>{{ $data->buyer_name }}</em>.

## <div style="margin-top: 30px; margin-bottom: -5px; color: #3D4852;">INVOICE {{ $data->order_id }}</div>

Tanggal Pemesanan : {{ formatDate($data->created_at, 'd F Y \j\a\m H.i') }} <br>
@if ($data->payment_status === "Belum Dibayar")
Status : <span class="tbr_text-bold tbr_text-danger">{{ $data->payment_status }}</span>
@else
Status : <span class="tbr_text-bold tbr_text-success">{{ $data->payment_status }}</span>
@endif

<div class="tbr_text-medium tbr_mb-1" style="color: #3D4852; margin-top: 30px;">Item Pemesanan :</div>

@foreach ($data->orderItems as $orderItem)
<div class="tbr_mb-3 tbr_fix_height">
<table class="tbr_table" border="0" cellspacing="0">

{{-- Column 1 --}}
<tr style="width: calc(50% - 6px); border-right: 0;">
<th>
<table border="0" cellspacing="0">
<tr>
<th>Item {{$loop->iteration}}</th>
</tr>
<tr>
<td>
{{ \Illuminate\Support\Str::limit($orderItem->service, 26, ' ...') }} <br>
{{ \Illuminate\Support\Str::limit($data->therapist->name, 26, ' ...') }}
</td>
</tr>   
</table>
</th>
</tr>

{{-- Column 2 --}}
<tr style="width: 25%; border-right: 0;">
<th>
<table border="0" cellspacing="0">
<tr>
<th>B. Layanan</th>
</tr>
<tr>
<td>
{{ formatPrice($orderItem->rate) }}
</td>
</tr>   
</table>
</th>
</tr>

{{-- Column 3 --}}
<tr style="width: 25%;">
<th>
<table border="0" cellspacing="0">
<tr>
<th>Subtotal</th>
</tr>
<tr>
<td>
{{ formatPrice($orderItem->rate) }}
</td>
</tr>   
</table>
</th>
</tr>
</table>
</div>
@endforeach

<span class="tbr_display-block tbr_text-center tbr_mb-1">Total yang harus dibayar pasien adalah :</span>
<span class="tbr_display-block tbr_text-center tbr_text-bold tbr_text-danger tbr_text-h2">{{ formatPrice($data->transaction_amount) }}</span>

@component('mail::button', ['url' => route('therapist.order.detail', $data->id)])
Lihat pesanan melalui aplikasi
@endcomponent

Jika Anda mengabaikan pesanan ini, maka tidak ada tindakan lebih lanjut yang diperlukan.

Salam Kami,<br>
{{ config('app.name') }}

@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

@slot('footer')
@component('mail::footer')
&copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
@endcomponent
@endslot
@endcomponent