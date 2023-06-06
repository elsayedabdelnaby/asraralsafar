<li class="menu-item menu-item-submenu @if (request()->routeIs('dashboard.sales.*')) menu-item-open menu-item-here @endif"
    aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="fas fa-file-invoice-dollar"></i>
        </span>
        <span class="menu-text">{{ __('dashboard.sales') }}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">{{ __('dashboard.sales') }}</span>
                </span>
            </li>
            @if(Auth()->user()->hasPermission('listing-customers'))
                <li class="menu-item {{ request()->routeIs('dashboard.sales.customers.index') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.sales.customers.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.customers') }}</span>
                </a>
            </li>
            @endif
            <li class="menu-item {{ request()->routeIs('dashboard.sales.orders.index') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.sales.orders.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.orders') }}</span>
                </a>
            </li>
            @if(Auth()->user()->role_id == 1)
                <li class="menu-item {{ request()->routeIs('dashboard.merchants.coupons.index-global') ? 'menu-item-active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.merchants.coupons.index-global') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-line">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.coupons') }}</span>
                    </a>
                </li>
            @endif


            @if(Auth()->user()->hasPermission('access-order-status'))
                <li class="menu-item {{ request()->routeIs('dashboard.sales.order-status.index') ? 'menu-item-active' : null }}"
                    aria-haspopup="true">
                    <a href="{{ route('dashboard.sales.order-status.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-line">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.orders-status') }}</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</li>
