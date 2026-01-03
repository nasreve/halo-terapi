<header class="header">
    <div class="logo-container">
        <a href="#" class="logo">
            <img src="{{ asset('assets/svg/etc/Logo.svg') }}" alt="Tukangbangun" class="img-fluid" />
        </a>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="header-right">
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <div class="profile-info">
                    <span class="name">{{ \Illuminate\Support\Str::words(Auth::user()->name, 2, '') }}</span>
                    <span class="role">{{ Auth::user()->role }}</span>
                </div>
                <span class="tbr_arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <g id="Layer_2" data-name="Layer 2" transform="translate(0.319 18) rotate(-90)" opacity="1">
                            <g id="arrow-ios-back">
                                <rect id="Rectangle_31" data-name="Rectangle 31" width="18" height="18" transform="translate(18 -0.319) rotate(90)" fill="#28AF52" opacity="0"/>
                                <path id="Path_3" data-name="Path 3" d="M12.256,15.225a.73.73,0,0,1-.57-.27L8.159,10.573a.73.73,0,0,1,0-.928l3.652-4.382a.731.731,0,1,1,1.125.935L9.671,10.112l3.155,3.915a.73.73,0,0,1-.57,1.2Z" transform="translate(-2.155 -1.348)" fill="#28AF52"/>
                            </g>
                        </g>
                    </svg>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <ul class="list-unstyled mb-0">
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{ route('my-profile.form') }}">
                            <i class="icon icon-settings"></i>{{ __('Profil Saya') }}
                        </a>
                    </li>
                    <li>
                        <a role="menuitem"
                            tabindex="-1"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon icon-logout"></i>{{ __('Keluar') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>