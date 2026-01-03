@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('assets/images/Email-Logo.png') }}" alt="{{ config('app.name') }}">
@endcomponent
@endslot

# Hallo, {{ $user->name }}

Terapis telah menambahkan Anda sebagai pasien di Haloterapi.
Silakan klik tombol di bawah ini untuk memverifikasi alamat email
sekaligus mengatur password Anda.

@component('mail::button', ['url' => route('patient.password.reset', ['token' => $token, 'email' => $email])])
Verifikasi dan atur password
@endcomponent

Jika Anda tidak berniat menjadi pasien di Haloterapi, maka tidak ada
tindakan lebih lanjut yang diperlukan.

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
