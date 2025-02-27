<li class="menu-item menu-item-submenu @if (request()->routeIs('dashboard.operations.*')) menu-item-open menu-item-here @endif"
    aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon svg-icon-2x">
            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Settings-2.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path
                        d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                        fill="#000000"/>
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-text">{{ __('dashboard.operations') }}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">{{ __('dashboard.operations') }}</span>
                </span>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.operations.activity-logs.index') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.operations.activity-logs.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.activity_logs') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.operations.contact-us.index') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.operations.contact-us.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.contact_us') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.operations.booking-requests.index') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.operations.booking-requests.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.booking_requests') }}</span>
                </a>
            </li>
        </ul>
    </div>
</li>
