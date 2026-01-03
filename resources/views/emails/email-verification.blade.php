@component('mail::layout')

@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('assets/images/Email-Logo.png') }}" alt="{{ config('app.name') }}">
@endcomponent
@endslot

# Hallo, {{ $user->name }}

@foreach ($introLines as $line)
{{ $line }}

@endforeach

@isset($actionText)
@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
{{ $actionText }}
@endcomponent
@endisset

Jika Anda tidak berniat atau ingin membatalkan dalam membuat akun di {{ config('app.name') }}, tidak ada tindakan lebih lanjut yang diperlukan.

Salam Kami,<br>
{{ config('app.name') }}

@slot('footer')
@component('mail::footer')
&copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
@endcomponent
@endslot

@endcomponent