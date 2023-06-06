<!--Start Coupons -->
@if(Auth()->user()->hasPermission('listing-merchant-coupons'))
    <li class="menu-item {{ request()->routeIs('dashboard.merchants.coupons.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
        <a href="{{ route('dashboard.merchants.coupons.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
            <i class="menu-bullet menu-bullet-line">
                <span></span>
            </i>
            <span class="menu-text">{{ __('merchants::dashboard.coupons') }}</span>
        </a>
    </li>
@endif
<!--End Coupons -->

