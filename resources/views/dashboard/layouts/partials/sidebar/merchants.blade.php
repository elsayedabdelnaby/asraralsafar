<li class="menu-item menu-item-submenu @if (request()->routeIs('dashboard.merchants.*') || request()->routeIs('dashboard.products.product-attributes.*')) menu-item-open menu-item-here @endif"
    aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="fas fa-house-user"></i>
        </span>
        <span class="menu-text">{{ __('dashboard.merchants') }}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <!--Start Listing Merchants -->
            @if(Auth()->user()->hasPermission('listing-merchants'))
                <li class="menu-item {{ request()->routeIs('dashboard.merchants.index') ? 'menu-item-active' : null }}" aria-haspopup="true">
                    <a href="{{ route('dashboard.merchants.index') }}" class="menu-link">
                        <i class="menu-bullet menu-bullet-line">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.merchants') }}</span>
                    </a>
                </li>
            @endif
            <!--End Listing Merchants -->

            @if(Auth()->user()->role_id == 2)
                @include('dashboard.layouts.partials.sidebar.merchant_manager.merchant',['merchant'=>Auth()->user()->merchant])
                @include('dashboard.layouts.partials.sidebar.merchant_manager.sales',['merchant'=>Auth()->user()->merchant])
            @endif


            <!--Start Product Attribute  -->
                @if(Auth()->user()->hasPermission('listing-product-attributes'))
                <li class="menu-item menu-item-submenu {{ request()->routeIs('dashboard.products.product-attributes.*') ? 'menu-item-open' : null }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-line">
                            <span></span>
                        </i>
                        <span class="menu-text">{{ __('dashboard.products') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->routeIs('dashboard.products.product-attributes.*') ? 'menu-item-active' : null }}"
                                aria-haspopup="true">
                                <a href="{{ route('dashboard.products.product-attributes.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('dashboard.product_attributes') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            <!--End Product Attribute  -->

            <!-- Start Delivery Adjustments -->
                @if (Auth()->user()->hasPermission('access-sales') && Auth()->user()->hasPermission('listing-merchant-delivery-adjustments'))

                    <li class="menu-item {{ request()->routeIs('dashboard.delivery-adjustment.index') ? 'menu-item-active' : null }}"
                        aria-haspopup="true">
                        <a href="{{ route('dashboard.merchants.delivery-adjustments.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('dashboard.delivery_adjustment') }}</span>
                        </a>
                    </li>
                @endif
            <!-- End Delivery Adjustments -->

        </ul>
    </div>
</li>
