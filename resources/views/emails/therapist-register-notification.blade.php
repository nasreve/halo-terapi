<style>
    .tbr_table { min-width: 500px; margin: 0; width: 100%; border-collapse: collapse; border-top: 0px solid #F1F1F1; border-bottom: 0px solid #F1F1F1; }
    .tbr_table-responsive { overflow-x: auto !important; }
    .tbr_table tr th, .tbr_table tr td { border: 1px solid #F5F5F5; padding: 8px 16px; outline: none; box-shadow: none; margin: 0; }
    .tbr_table tr th    { background-color: #F5F5F5; }
    .tbr_table tr td    { background-color: #FFFFFF; }
    .tbr_text-left      { text-align: left !important; }
    .tbr_text-right     { text-align: right !important; }
    .tbr_text-center    { text-align: center !important; }
    .tbr_display-block  { display: block !important }
    .tbr_text-regular   { font-weight: 400 !important; }
    .tbr_text-medium    { font-weight: 500 !important; }
    .tbr_text-semi-bold { font-weight: 600 !important; }
    .tbr_text-bold      { font-weight: 700 !important; }
    .tbr_text-dark      { color: #3D4852 !important; }
    .tbr_text-danger    { color: #F8374B !important; }
    .tbr_text-success   { color: #28AF52 !important; }
    .tbr_text-h2        { font-size: 22px !important; }
    .tbr_mb-1           { margin-bottom: 10px !important }
    .tbr_mb-2           { margin-bottom: 20px !important }
    .tbr_mb-3           { margin-bottom: 30px !important }
    .tbr_mb-4           { margin-bottom: 40px !important }
    .tbr_mb-5           { margin-bottom: 50px !important }
</style>

@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('assets/images/Email-Logo.png') }}" alt="{{ config('app.name') }}">
@endcomponent
@endslot

# Hallo, {{ $data->name }}

@if ($data->status === "Disetujui")
Selamat! Kami ({{ config('app.name') }}) telah menyetujui Anda sebagai terapis kami. Klik tombol di bawah untuk masuk ke halaman Anda.
@component('mail::button', ['url' => route('therapist.order.history')])
Masuk ke aplikasi
@endcomponent

Pada halaman tersebut, Anda dapat mengubah data pribadi, pengalaman, layanan, rekening, jadwal pelayanan, dll.

Jika tidak ada yang perlu diatur, maka tidak ada tindakan lebih lanjut yang diperlukan.
@elseif ($data->status === "Ditolak")
Kami ({{ config('app.name') }}) menginformasikan bahwa Anda tidak diterima sebagai terapis kami. Dikarenakan ada beberapa kriteria yang tidak memenuhi persyaratan.
@endif



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
