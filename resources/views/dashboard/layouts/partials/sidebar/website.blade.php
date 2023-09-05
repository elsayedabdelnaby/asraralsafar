<li class="menu-item menu-item-submenu
                @if (request()->routeIs('dashboard.website.*')) menu-item-open menu-item-here @endif"
    aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16">
                    </rect>
                    <path
                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                        fill="#000000" fill-rule="nonzero"></path>
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-text">{{ __('dashboard.website_information') }}</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item {{ request()->routeIs('dashboard.website.information.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.information.edit', 1) }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('website::dashboard.information') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.privacy-policies.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.privacy-policies.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.privacy_policies') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.terms-conditions.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.terms-conditions.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.terms_conditions') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.faqs.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.faqs.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.faqs') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.blogs.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.blogs.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.blogs') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.contact-informations.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.contact-informations.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.contact_informations') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.social-links.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.social-links.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.social_links') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.meta-pages.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.meta-pages.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.meta_pages') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.footer-sections.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.footer-sections.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.footer_sections') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.about-us.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.about-us.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.about_us') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.partners.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.partners.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.partners') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.testimonails.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.testimonails.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.testimonails') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.main-sliders.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.main-sliders.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.main_sliders') }}</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard.website.services.*') ? 'menu-item-active' : null }}"
                aria-haspopup="true">
                <a href="{{ route('dashboard.website.services.index') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-line">
                        <span></span>
                    </i>
                    <span class="menu-text">{{ __('dashboard.services') }}</span>
                </a>
            </li>
        </ul>
    </div>
</li>
