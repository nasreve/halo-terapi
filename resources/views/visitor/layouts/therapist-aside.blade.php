<div class="tbr_member_aside">
    <div class="tbr_therapist_image">
        <div class="tbr_card_image">
            <img class="w-100" src="{{ Storage::url($therapist->photo_path) }}" alt="{{ $therapist->name }}">
        </div>
        <a href="#" class="tbr_change_photo" data-toggle="modal" data-target="#therapistChangePhoto">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
                <g id="edit">
                    <rect id="Rectangle_1579" data-name="Rectangle 1579" width="24" height="24" fill="#8ccc54" opacity="0"/>
                    <path id="Path_594" data-name="Path 594" d="M19.4,7.34,16.66,4.6A2,2,0,0,0,14,4.53l-9,9a2,2,0,0,0-.57,1.21L4,18.91A1,1,0,0,0,5,20h.09l4.17-.38a2,2,0,0,0,1.21-.57l9-9a1.92,1.92,0,0,0-.07-2.71ZM9.08,17.62l-3,.28.27-3L12,9.32l2.7,2.7ZM16,10.68,13.32,8l1.95-2L18,8.73Z" fill="#8ccc54"/>
                </g>
            </svg>
        </a>
    </div>
    @include('visitor.partials.therapist-change-photo')
    <ul class="tbr_member_menu">
        <li class="tbr_member_nav_history_order">
            <a href="{{ route('therapist.order.history') }}">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
                    <g id="clipboard">
                        <rect id="Rectangle_1500" data-name="Rectangle 1500" width="24" height="24" fill="#8a949b" opacity="0"/>
                        <path id="Path_561" data-name="Path 561" d="M18,5V4a2,2,0,0,0-2-2H8A2,2,0,0,0,6,4V5A3,3,0,0,0,3,8V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V8A3,3,0,0,0,18,5ZM8,4h8V8H8ZM19,19a1,1,0,0,1-1,1H6a1,1,0,0,1-1-1V8A1,1,0,0,1,6,7V8a2,2,0,0,0,2,2h8a2,2,0,0,0,2-2V7a1,1,0,0,1,1,1Z" fill="#8a949b"/>
                    </g>
                </svg>
                @if ($shareOrder->count())
                    <div class="therapist-order-count">
                        {{ $shareOrder->count() }}
                    </div>
                @endif
                <span>Data Pesanan</span>
            </a>
        </li>
        <li class="tbr_member_nav_report">
            <a href="{{ route('therapist.report') }}">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
                    <g id="file-text">
                        <rect id="Rectangle_1729" data-name="Rectangle 1729" width="24" height="24" fill="#8a949b" opacity="0"/>
                        <path id="Path_684" data-name="Path 684" d="M15,16H9a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2Z" fill="#8a949b"/>
                        <path id="Path_685" data-name="Path 685" d="M9,14h3a1,1,0,0,0,0-2H9a1,1,0,0,0,0,2Z" fill="#8a949b"/>
                        <path id="Path_686" data-name="Path 686" d="M19.74,8.33l-5.44-6A1,1,0,0,0,13.56,2h-7A2.53,2.53,0,0,0,4,4.5v15A2.53,2.53,0,0,0,6.56,22H17.44A2.53,2.53,0,0,0,20,19.5V9a1,1,0,0,0-.26-.67ZM14,5l2.74,3h-2A.79.79,0,0,1,14,7.15Zm3.44,15H6.56A.53.53,0,0,1,6,19.5V4.5A.53.53,0,0,1,6.56,4H12V7.15A2.79,2.79,0,0,0,14.71,10H18v9.5a.53.53,0,0,1-.56.5Z" fill="#8a949b"/>
                    </g>
                </svg>
                <span>Laporan Transaksi</span>
            </a>
        </li>
        <li class="tbr_member_nav_referral {{ $therapist->referrer()->exists() && $therapist->referrer->blocked === 0  ? "active" : "" }}">
            <a href="{{ $therapist->referrer()->exists() ? route('therapist.referral.dashboard') : route('therapist.referral.confirmation') }}">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
                    <g id="link-2">
                        <rect id="Rectangle_1531" data-name="Rectangle 1531" width="24" height="24" fill="#8a949b" opacity="0"/>
                        <path id="Path_572" data-name="Path 572" d="M13.29,9.29l-4,4a1,1,0,1,0,1.42,1.42l4-4a1,1,0,0,0-1.42-1.42Z" fill="#8a949b"/>
                        <path id="Path_573" data-name="Path 573" d="M12.28,17.4,11,18.67a4.2,4.2,0,0,1-5.58.4,4,4,0,0,1-.27-5.93l1.42-1.43a1,1,0,1,0-1.42-1.42L3.88,11.57a6.15,6.15,0,0,0-.67,8.07,6.06,6.06,0,0,0,9.07.6l1.42-1.42a1,1,0,1,0-1.42-1.42Z" fill="#8a949b"/>
                        <path id="Path_574" data-name="Path 574" d="M19.66,3.22a6.18,6.18,0,0,0-8.13.68L10.45,5a1.09,1.09,0,0,0-.17,1.61,1,1,0,0,0,1.42,0L13,5.3a4.17,4.17,0,0,1,5.57-.4,4,4,0,0,1,.27,5.95l-1.42,1.43a1,1,0,1,0,1.42,1.42l1.42-1.42a6.06,6.06,0,0,0-.6-9.06Z" fill="#8a949b"/>
                    </g>
                </svg>
                <span>Program Referral</span>
            </a>
        </li>
        <li class="tbr_member_nav_setting">
            <a href="{{ route('therapist.setting') }}">
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" width="24" height="24" viewBox="0 0 24 24">
                    <g id="settings">
                        <rect id="Rectangle_1499" data-name="Rectangle 1499" width="24" height="24" fill="#8a949b" opacity="0"/>
                        <path id="_Group_" data-name="&lt;Group&gt;" d="M8.61,22a2.25,2.25,0,0,1-1.35-.46L5.19,20a2.37,2.37,0,0,1-.49-3.22,2.06,2.06,0,0,0,.23-1.86l-.06-.16a1.83,1.83,0,0,0-1.12-1.22H3.59A2.34,2.34,0,0,1,2.11,10.6L2.93,8A2.18,2.18,0,0,1,4.05,6.59a2.14,2.14,0,0,1,1.68-.12,1.93,1.93,0,0,0,1.78-.29l.13-.1a1.94,1.94,0,0,0,.73-1.51V4.33A2.32,2.32,0,0,1,10.66,2h2.55a2.26,2.26,0,0,1,1.6.67,2.37,2.37,0,0,1,.68,1.68v.28a1.76,1.76,0,0,0,.69,1.43l.11.08a1.74,1.74,0,0,0,1.59.26l.34-.11A2.26,2.26,0,0,1,21.1,7.8l.79,2.52a2.36,2.36,0,0,1-1.46,2.93l-.2.07A1.89,1.89,0,0,0,19,14.6a2,2,0,0,0,.25,1.65l.26.38a2.38,2.38,0,0,1-.5,3.23L17,21.41a2.24,2.24,0,0,1-3.22-.53l-.12-.17a1.75,1.75,0,0,0-1.5-.78,1.8,1.8,0,0,0-1.43.77l-.23.33A2.25,2.25,0,0,1,9,22,2,2,0,0,1,8.61,22ZM4.4,11.62a3.83,3.83,0,0,1,2.38,2.5v.12a4,4,0,0,1-.46,3.62.38.38,0,0,0,0,.51L8.47,20a.25.25,0,0,0,.37-.07l.23-.33a3.77,3.77,0,0,1,6.2,0l.12.18a.3.3,0,0,0,.18.12.25.25,0,0,0,.19-.05l2.06-1.56a.36.36,0,0,0,.07-.49l-.26-.38A4,4,0,0,1,17.1,14a3.92,3.92,0,0,1,2.49-2.61l.2-.07a.34.34,0,0,0,.19-.44L19.2,8.39A.35.35,0,0,0,19,8.2a.21.21,0,0,0-.19,0l-.34.11a3.74,3.74,0,0,1-3.43-.57L15,7.65a3.76,3.76,0,0,1-1.49-3V4.34a.37.37,0,0,0-.1-.26A.31.31,0,0,0,13.2,4H10.66a.31.31,0,0,0-.29.33v.25A3.9,3.9,0,0,1,8.85,7.67l-.13.1a3.91,3.91,0,0,1-3.63.59.22.22,0,0,0-.14,0,.28.28,0,0,0-.12.15L4,11.12a.36.36,0,0,0,.22.45Z" fill="#8a949b"/>
                        <path id="Path_560" data-name="Path 560" d="M12,15.5A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Zm0-5A1.5,1.5,0,1,0,13.5,12,1.5,1.5,0,0,0,12,10.5Z" fill="#8a949b"/>
                    </g>
                </svg>
                <span>Pengaturan</span>
            </a>
        </li>
    </ul>
</div>

@push('scripts')
    <script>
        $(function () {
            $("html, body").animate({ scrollTop: 0 }, "fast");
        })
    </script>
@endpush