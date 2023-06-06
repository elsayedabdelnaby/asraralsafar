<!-- Start  Branches -->
@if(Auth()->user()->hasPermission('listing-merchant-branches'))
    <li class="menu-item {{ request()->routeIs('dashboard.merchants.branches.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
        <a href="{{ route('dashboard.merchants.branches.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
            <i class="menu-bullet menu-bullet-line">
                <span></span>
            </i>
            <span class="menu-text">{{ __('merchants::dashboard.branches') }}</span>
        </a>
    </li>
@endif
<!-- End Branches -->

<!--Start Working Hours -->
@if(Auth()->user()->hasPermission('listing-merchant-working-hours'))
    <li class="menu-item {{ request()->routeIs('dashboard.merchants.working-hours.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
        <a href="{{ route('dashboard.merchants.working-hours.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
            <i class="menu-bullet menu-bullet-line">
                <span></span>
            </i>
            <span class="menu-text">{{ __('merchants::dashboard.working_hours') }}</span>
        </a>
    </li>
@endif
<!--End Working Hours -->

<!--Start Socials-->
@if(Auth()->user()->hasPermission('listing-merchant-socials'))
    <li class="menu-item {{ request()->routeIs('dashboard.merchants.social.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
    <a href="{{ route('dashboard.merchants.social.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
        <i class="menu-bullet menu-bullet-line">
            <span></span>
        </i>
        <span class="menu-text">{{ __('merchants::dashboard.social') }}</span>
    </a>
</li>
@endif
<!--End Socials-->

<!--Start Reviews-->
<li class="menu-item" aria-haspopup="true">
        <a href="#" class="menu-link">
            <i class="menu-bullet menu-bullet-line">
                <span></span>
            </i>
            <span class="menu-text">{{ __('merchants::dashboard.reviews') }}</span>
        </a>
    </li>
<!--End Reviews-->


<!--Start Products Additions-->
@if(Auth()->user()->hasPermission('listing-merchant-additions-products'))
    <li class="menu-item {{ request()->routeIs('dashboard.merchants.additions-products.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
    <a href="{{ route('dashboard.merchants.additions-products.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
        <i class="menu-bullet menu-bullet-line">
            <span></span>
        </i>
        <span class="menu-text">{{ __('merchants::dashboard.additions_products') }}</span>
    </a>
</li>
@endif
<!--End Products Additions-->


<!--Start merchant-fees-->
@if(Auth()->user()->hasPermission('listing-merchant-delivery-fees'))
    <li class="menu-item {{ request()->routeIs('dashboard.merchants.merchant-fees.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
        <a href="{{ route('dashboard.merchants.merchant-fees.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
            <i class="menu-bullet menu-bullet-line">
                <span></span>
            </i>
            <span class="menu-text">{{ __('merchants::dashboard.delivery_fees') }}</span>
        </a>
    </li>
@endif
<!--End Delivery Fees-->


<!--Start Products-->
@if(Auth()->user()->hasPermission('listing-products'))
<li class="menu-item {{ request()->routeIs('dashboard.merchants.products.*') ? 'menu-item-active' : null }}" aria-haspopup="true">
    <a href="{{ route('dashboard.merchants.products.index',['merchant_id'=>$merchant->id]) }}" class="menu-link">
        <i class="menu-bullet menu-bullet-line">
            <span></span>
        </i>
        <span class="menu-text">{{ __('merchants::dashboard.products') }}</span>
    </a>
</li>
@endif
<!--End Products-->
