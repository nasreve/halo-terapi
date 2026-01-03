@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('assets/images/Email-Logo.png') }}" alt="{{ config('app.name') }}">
@endcomponent
@endslot

# Hallo, {{ $user->name }}

Anda menerima email ini karena kami menerima permintaan pengaturan ulang password untuk akun Anda.

@if ($provider === 'user')
@component('mail::button', ['url' => route('password.reset', ['token' => $token, 'email' => $email])])
Reset Password
@endcomponent
@elseif ($provider === 'patient')
@component('mail::button', ['url' => route('patient.password.reset', ['token' => $token, 'email' => $email])])
Reset Password
@endcomponent
@elseif ($provider === 'therapist')
@component('mail::button', ['url' => route('therapist.password.reset', ['token' => $token, 'email' => $email])])
Reset Password
@endcomponent
@endif

@if ($provider === 'user')
Link atau tautan pengaturan ulang password ini akan kedaluwarsa dalam {{ config('auth.passwords.users.expire') }} menit.
@elseif ($provider === 'patient')
Link atau tautan pengaturan ulang password ini akan kedaluwarsa dalam {{ config('auth.passwords.patients.expire') }} menit.
@elseif ($provider === 'therapist')
Link atau tautan pengaturan ulang password ini akan kedaluwarsa dalam {{ config('auth.passwords.therapists.expire') }} menit.
@endif

Jika Anda tidak meminta pengaturan ulang password, tidak ada tindakan lebih lanjut yang diperlukan.

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
