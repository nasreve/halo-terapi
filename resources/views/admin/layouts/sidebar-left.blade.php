<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">{{ __('Navigation') }}</div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(238, 238, 238, 1);transform:;-ms-filter:"><path d="M4 6H20V8H4zM4 11H20V13H4zM4 16H20V18H4z"></path></svg>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main mt-4">
                    <li class="tbr_order">
                        @if ($unpaidOrderCount)
                        <span class="badge badge-danger">{{ $unpaidOrderCount }}</span>
                        @endif
                        <a href="{{ route('order.index') }}" class="nav-link">
                            <img src="{{ asset('assets/svg/icon_aside_bag.svg') }}" alt="icon_menu_order">
                            <span>Pesanan</span>
                        </a>
                    </li>
                    <li class="tbr_patient">
                        <a href="{{ route('patient.index') }}" class="nav-link">
                            <img src="{{ asset('assets/svg/icon_aside_users.svg') }}" alt="icon_menu_patient">
                            <span>Pasien</span>
                        </a>
                    </li>
                    <li class="tbr_therapist">
                        @if ($statusTherapistCount)
                        <span class="badge badge-danger">{{ $statusTherapistCount }}</span>
                        @endif
                        <a href="{{ route('therapist.index') }}" class="nav-link">
                            <img src="{{ asset('assets/svg/icon_aside_award.svg') }}" alt="icon_aside_award">
                            <span>Terapis</span>
                        </a>
                    </li>
                    <li class="tbr_referrer">
                        <a href="{{ route('referrer.index') }}" class="nav-link">
                            <img src="{{ asset('assets/svg/icon_aside_link.svg') }}" alt="icon_aside_link">
                            <span>Referrer</span>
                        </a>
                    </li>
                    <li class="tbr_report">
                        <a href="{{ route('report.index') }}" class="nav-link">
                            <img src="{{ asset('assets/svg/icon_aside_pie_chart.svg') }}" alt="icon_aside_pie_chart">
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li class="nav-parent tbr_setting">
                        <a href="#" class="nav-link">
                            <img src="{{ asset('assets/svg/icon_aside_gear.svg') }}" alt="icon_aside_gear">
                            <span>Pengaturan</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="tbr_setting_myprofile">
                                <a href="{{ route('my-profile.form') }}">
                                    Profil Saya
                                </a>
                            </li>
                            <li class="tbr_setting_system">
                                <a href="{{ route('system.form') }}">
                                    Sistem
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
