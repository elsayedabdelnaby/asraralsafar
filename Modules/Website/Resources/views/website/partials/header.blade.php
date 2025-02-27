<header class="main_header_area">
    <div class="header-content py-1 bg-theme">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="links">
                <ul>
                    <li>
                        <span class="text-white fs-12"><i class="icon-calendar text-white me-1"></i>Sat-Fri: 10.00
                            AM – 6.00 PM</span>
                    </li>
                    <li>
                        <a href="{{ $websiteInfo->address_google_map_link }}" class="text-white fs-12" target="_blank"><i
                                class="icon-location-pin white me-1"></i>
                            {{ $websiteInfo->translations()->where('language_id', getCurrentLanguage()->id)->first()->address }}</a>
                    </li>
                    <!-- Render of these according to language. -->
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(getMainLanguage()->code) }}"
                            class="text-white fs-12"><img class="me-1" width="20" height="auto"
                                src="{{ global_asset('website/images/008-saudi-arabia.svg') }}" alt="Arabic" />
                            {{ app()->getLocale() == 'en' ? 'Arabic' : 'Arabic' }}</a>
                    </li>
                </ul>
            </div>
            <div class="links float-right">
                <ul>
                    @foreach ($socialLinks as $link)
                        <li>
                            <a href="{{ $link->url }}" class="white" target="_blank">
                                <img src="{{ $link->icon_url }}" alt="social" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Navigation Bar -->
    <div class="header_menu" id="header_menu">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-3 pt-3">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ global_asset("storage/website/$websiteInfo->main_logo") }}" width="150"
                                alt="image" />
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">@lang('website.Bookings')
                                    <i class="icon-arrow-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    @foreach ($services as $service)
                                        <li class="submenu">
                                            <a
                                                href="{{ route('website.services.show', $service->slug) }}">{{ $service->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="{{ route('website.blog.index') }}">@lang('website.Blogs')</a>
                            </li>
                            <li class="submenu">
                                <a href="{{ route('contact.index') }}">@lang('website.Contact Us')</a>
                            </li>
                            <li class="submenu">
                                <a href="{{ route('about-us.index') }}">@lang('website.About Us')</a>
                            </li>
                            {{-- <li class="search-main">
                                <a href="#search1" class="mt_search"><i class="fa fa-search"></i></a>
                            </li> --}}
                            <li class="submenu">
                                <a href="{{ url('/') }}">@lang('website.home')</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="register-login d-flex align-items-center">
                        {{-- <a href="{{ route('request.index') }}" class="nir-btn white">@lang('website.Book Now')</a> --}}
                    </div>

                    <div id="slicknav-mobile"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
    <!-- Navigation Bar Ends -->
</header>
