<header class="tbr_header">
    <div class="row">
        <div class="col">
            <div class="tbr_header_wrap">
                <a href="{{ url('/') }}">
                    <div class="tbr_brand">
                        <img src="{{ asset('assets/svg/etc/Logo.svg') }}" alt="Haloterapi">
                    </div>
                </a>
                <div class="d-web">
                    <div class="tbr_navigations">
                        <div class="tbr_primary_menu">
                            <ul>
                                <li class="tbr_nav_home">
                                    <a href="/">Home</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tbr_open_nav">
                            <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-danger openDrawer">
                                <i class="icon icon-menu"></i>
                            </button>
                        </div>
                        <div class="tbr_nav_auth">
                            @if (!auth()->guard('therapist')->check() && !auth()->guard('patient')->check())
                                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-login mr-3" data-toggle="modal" data-target="#modalLogin" id="loginButton">
                                    Login
                                </button>
                                <button
                                    type="button"
                                    anim="ripple"
                                    class="btn tbr_btn tbr_btn-register"
                                    id="registerButton"
                                    data-toggle="dropdown"
                                >
                                    <div class="tbr_open">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                                            <g id="Group_1" data-name="Group 1" transform="translate(-1086 -466)">
                                                <path id="Path_196" data-name="Path 196" d="M9,11A4,4,0,1,0,5,7,4,4,0,0,0,9,11ZM9,5A2,2,0,1,1,7,7,2,2,0,0,1,9,5Z" transform="translate(1084 463)" fill="#fff"/>
                                                <path id="Path_197" data-name="Path 197" d="M17,13a3,3,0,1,0-3-3A3,3,0,0,0,17,13Zm0-4a1,1,0,1,1-1,1A1,1,0,0,1,17,9Z" transform="translate(1084 463)" fill="#fff"/>
                                                <path id="Path_198" data-name="Path 198" d="M17,14a5,5,0,0,0-3.06,1.05A7,7,0,0,0,2,20a1,1,0,1,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,6.9,6.9,0,0,0-.86-3.35A3,3,0,0,1,20,19a1,1,0,1,0,2,0A5,5,0,0,0,17,14Z" transform="translate(1084 463)" fill="#fff"/>
                                            </g>
                                        </svg>
                                        Register
                                    </div>
                                    <div class="tbr_close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12.012" height="12.01" viewBox="0 0 12.012 12.01">
                                            <path id="Path_1" data-name="Path 1" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" transform="translate(-5.994 -5.996)" fill="#fff"/>
                                        </svg>
                                        Close
                                    </div>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right tbr_mega_menu p-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <img src="{{ asset('/assets/svg/illustration/patient.svg') }}" alt="Patient">
                                                    <p class="tbr_lead">
                                                        Daftar sebagai pasien memudahkan dalam proses pemesanan.
                                                    </p>
                                                    <a href="{{ route('patient.register') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary m-auto">Saya sebagai pasien</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <img src="{{ asset('/assets/svg/illustration/therapist.svg') }}" alt="Patient">
                                                    <p class="tbr_lead">
                                                        Daftar sebagai terapis dan dapatkan pasien dengan mudah.
                                                    </p>
                                                    <a href="{{ route('therapist.register.step-1') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary m-auto">Saya sebagai terapis</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <img src="{{ asset('/assets/svg/illustration/referrer.svg') }}" alt="Patient">
                                                    <p class="tbr_lead">
                                                        Daftar sebagai referrer dan dapatkan pemasukkan tambahan.
                                                    </p>
                                                    <a href="{{ route('referrer.register') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary m-auto">Saya sebagai referrer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
    
                            @auth('patient')
                                <form id="logout-form" action="{{ route('patient.logout') }}" method="post">
                                    @csrf
                                </form>
                                <div class="tbr_userbox">
                                    <a href="#" data-toggle="dropdown">
                                        <div class="profile-info">
                                            <span class="tbr_name">{{ Str::limit(auth()->guard('patient')->user()->name, 20, ' ...') }}</span>
                                            <span class="tbr_role">Pasien</span>
                                        </div>
                                        <i class="icon icon-arrow-down custom-arrow-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="list-unstyled">
                                            <li class="tbr_nav_order">
                                                <a href="{{ route('patient.order.history') }}" role="menuitem" tabindex="-1" href="">Pesanan Saya</a>
                                            </li>
                                            <li class="tbr_nav_referrer">
                                                <a href="{{ $patient->referrer()->exists() ? route('patient.referral.dashboard') : route('patient.referral.confirmation') }}" role="menuitem" tabindex="-1" href="">Program Referral</a>
                                            </li>
                                            <li class="tbr_nav_setting">
                                                <a href="{{ route('patient.setting') }}" role="menuitem" tabindex="-1" href="">Pengaturan</a>
                                            </li>
                                            <li>
                                                <a
                                                    role="menuitem"
                                                    tabindex="-1"
                                                    href=""
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    Keluar
                                                </a>
                                                <form id="logout-form" action="" method="POST" class="d-none">@csrf</form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endauth
    
                            @auth('therapist')
                                <form id="logout-form" action="{{ route('therapist.logout') }}" method="post">
                                    @csrf
                                </form>
                                <div class="tbr_userbox">
                                    <a href="#" data-toggle="dropdown">
                                        <div class="profile-info">
                                            <span class="tbr_name">{{ Str::limit(auth()->guard('therapist')->user()->name, 20, ' ...') }}</span>
                                            <span class="tbr_role">Terapis</span>
                                        </div>
                                        <i class="icon icon-arrow-down custom-arrow-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="list-unstyled">
                                            <li class="tbr_nav_order">
                                                <a href="{{ route('therapist.order.history') }}" role="menuitem" tabindex="-1" href="">Pesanan Saya</a>
                                            </li>
                                            <li class="tbr_nav_referrer">
                                                <a href="{{ $therapist->referrer()->exists() ? route('therapist.referral.dashboard') : route('therapist.referral.confirmation') }}" role="menuitem" tabindex="-1" href="">Program Referral</a>
                                            </li>
                                            <li class="tbr_nav_setting">
                                                <a href="{{ route('therapist.setting') }}" role="menuitem" tabindex="-1" href="">Pengaturan</a>
                                            </li>
                                            <li>
                                                <a
                                                    role="menuitem"
                                                    tabindex="-1"
                                                    href=""
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    Keluar
                                                </a>
                                                <form id="logout-form" action="" method="POST" class="d-none">@csrf</form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endauth
                        </div>  
                        <div class="tbr_whatsapp">
                            <a href="https://api.whatsapp.com/send/?phone=6281393108310" target="_blank">
                                <img src="{{ asset('/assets/svg/icons/cta_whatsapp.svg') }}" alt="WhatsApp">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-mobile">
                    <div class="tbr_navigations">
                        <div class="d-flex">
                            <div class="tbr_primary_menu">
                                <ul>
                                    <li class="tbr_nav_home">
                                        <a href="/">Home</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tbr_open_nav">
                                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-danger openDrawer">
                                    <i class="icon icon-menu"></i>
                                </button>
                            </div>
                            <div class="tbr_whatsapp mx-2">
                                <a href="https://api.whatsapp.com/send/?phone=6281393108310" target="_blank">
                                    <img src="{{ asset('/assets/svg/icons/cta_whatsapp.svg') }}" alt="WhatsApp">
                                </a>
                            </div> 
                        </div>
                        <div class="tbr_nav_auth">
                            @if (!auth()->guard('therapist')->check() && !auth()->guard('patient')->check())
                                <button type="button" anim="ripple" class="btn tbr_btn tbr_btn-login mr-2" data-toggle="modal" data-target="#modalLogin" id="loginButton">
                                    Login
                                </button>
                                <button
                                    type="button"
                                    anim="ripple"
                                    class="btn tbr_btn tbr_btn-register"
                                    id="registerButton"
                                    data-toggle="dropdown"
                                >
                                    <div class="tbr_open">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                                            <g id="Group_1" data-name="Group 1" transform="translate(-1086 -466)">
                                                <path id="Path_196" data-name="Path 196" d="M9,11A4,4,0,1,0,5,7,4,4,0,0,0,9,11ZM9,5A2,2,0,1,1,7,7,2,2,0,0,1,9,5Z" transform="translate(1084 463)" fill="#fff"/>
                                                <path id="Path_197" data-name="Path 197" d="M17,13a3,3,0,1,0-3-3A3,3,0,0,0,17,13Zm0-4a1,1,0,1,1-1,1A1,1,0,0,1,17,9Z" transform="translate(1084 463)" fill="#fff"/>
                                                <path id="Path_198" data-name="Path 198" d="M17,14a5,5,0,0,0-3.06,1.05A7,7,0,0,0,2,20a1,1,0,1,0,2,0,5,5,0,0,1,10,0,1,1,0,0,0,2,0,6.9,6.9,0,0,0-.86-3.35A3,3,0,0,1,20,19a1,1,0,1,0,2,0A5,5,0,0,0,17,14Z" transform="translate(1084 463)" fill="#fff"/>
                                            </g>
                                        </svg>
                                        Register
                                    </div>
                                    <div class="tbr_close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12.012" height="12.01" viewBox="0 0 12.012 12.01">
                                            <path id="Path_1" data-name="Path 1" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,1,0,1.42,1.42L12,13.41l4.29,4.3a1,1,0,1,0,1.42-1.42Z" transform="translate(-5.994 -5.996)" fill="#fff"/>
                                        </svg>
                                        Close
                                    </div>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right tbr_mega_menu p-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <img src="{{ asset('/assets/svg/illustration/patient.svg') }}" alt="Patient">
                                                    <p class="tbr_lead">
                                                        Daftar sebagai pasien memudahkan dalam proses pemesanan.
                                                    </p>
                                                    <a href="{{ route('patient.register') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary m-auto">Saya sebagai pasien</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <img src="{{ asset('/assets/svg/illustration/therapist.svg') }}" alt="Patient">
                                                    <p class="tbr_lead">
                                                        Daftar sebagai terapis dan dapatkan pasien dengan mudah.
                                                    </p>
                                                    <a href="{{ route('therapist.register.step-1') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary m-auto">Saya sebagai terapis</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-center">
                                                    <img src="{{ asset('/assets/svg/illustration/referrer.svg') }}" alt="Patient">
                                                    <p class="tbr_lead">
                                                        Daftar sebagai referrer dan dapatkan pemasukkan tambahan.
                                                    </p>
                                                    <a href="{{ route('referrer.register') }}" anim="ripple" class="btn tbr_btn tbr_btn-primary m-auto">Saya sebagai referrer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
    
                            @auth('patient')
                                <form id="logout-form" action="{{ route('patient.logout') }}" method="post">
                                    @csrf
                                </form>
                                <div class="tbr_userbox">
                                    <a href="#" data-toggle="dropdown">
                                        <div class="profile-info">
                                            <span class="tbr_name">{{ Str::limit(auth()->guard('patient')->user()->name, 20, ' ...') }}</span>
                                            <span class="tbr_role">Pasien</span>
                                        </div>
                                        <i class="icon icon-arrow-down custom-arrow-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="list-unstyled">
                                            <li class="tbr_nav_order">
                                                <a href="{{ route('patient.order.history') }}" role="menuitem" tabindex="-1" href="">Pesanan Saya</a>
                                            </li>
                                            <li class="tbr_nav_referrer">
                                                <a href="{{ $patient->referrer()->exists() ? route('patient.referral.dashboard') : route('patient.referral.confirmation') }}" role="menuitem" tabindex="-1" href="">Program Referral</a>
                                            </li>
                                            <li class="tbr_nav_setting">
                                                <a href="{{ route('patient.setting') }}" role="menuitem" tabindex="-1" href="">Pengaturan</a>
                                            </li>
                                            <li>
                                                <a
                                                    role="menuitem"
                                                    tabindex="-1"
                                                    href=""
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    Keluar
                                                </a>
                                                <form id="logout-form" action="" method="POST" class="d-none">@csrf</form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endauth
    
                            @auth('therapist')
                                <form id="logout-form" action="{{ route('therapist.logout') }}" method="post">
                                    @csrf
                                </form>
                                <div class="tbr_userbox">
                                    <a href="#" data-toggle="dropdown">
                                        <div class="profile-info">
                                            <span class="tbr_name">{{ Str::limit(auth()->guard('therapist')->user()->name, 20, ' ...') }}</span>
                                            <span class="tbr_role">Terapis</span>
                                        </div>
                                        <i class="icon icon-arrow-down custom-arrow-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="list-unstyled">
                                            <li class="tbr_nav_order">
                                                <a href="{{ route('therapist.order.history') }}" role="menuitem" tabindex="-1" href="">Pesanan Saya</a>
                                            </li>
                                            <li class="tbr_nav_referrer">
                                                <a href="{{ $therapist->referrer()->exists() ? route('therapist.referral.dashboard') : route('therapist.referral.confirmation') }}" role="menuitem" tabindex="-1" href="">Program Referral</a>
                                            </li>
                                            <li class="tbr_nav_setting">
                                                <a href="{{ route('therapist.setting') }}" role="menuitem" tabindex="-1" href="">Pengaturan</a>
                                            </li>
                                            <li>
                                                <a
                                                    role="menuitem"
                                                    tabindex="-1"
                                                    href=""
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                    Keluar
                                                </a>
                                                <form id="logout-form" action="" method="POST" class="d-none">@csrf</form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endauth
                        </div> 
                    </div>
                </div>
                     
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
    </div> --}}
    @yield('openMemberAside')
</header>