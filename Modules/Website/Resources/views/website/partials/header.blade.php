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
                        <a href="#" class="text-white fs-12"><i class="icon-location-pin white me-1"></i> Dokki,
                            Egypt</a>
                    </li>
                    <!-- Render of these according to language. -->
                    <li>
                        <a href="{{ route('set-locale') }}" class="text-white fs-12"><img class="me-1" width="20"
                                height="auto" src="{{ asset('website/images/egypt.svg') }}" alt="Arabic" />
                            {{ app()->getLocale() == 'en' ? 'Arabic' : 'English' }}</a>
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
                    {{-- <li>
                        <a href="#" class="white"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#" class="white"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#" class="white"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                    </li> --}}
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
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset("storage/website/$websiteInfo->main_logo") }}" width="150"
                                alt="image" />
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            <li class="dropdown submenu active">
                                <a href="{{ route('website.index') }}" class="dropdown-toggle">Home</a>
                            </li>

                            <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Programs
                                    <i class="icon-arrow-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('package.index') }}">Offers</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('package.index') }}">Packages</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('package.index') }}">Package / Offer Details</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Bookings
                                    <i class="icon-arrow-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="submenu">
                                        <a href="{{ route('flight.index') }}">Flights</a>
                                    </li>
                                    <li class="submenu">
                                        <a href="{{ route('flight.index') }}">Hotels</a>
                                    </li>
                                    <li class="submenu">
                                        <a href="{{ route('cruise.index') }}">Cruises</a>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="{{ route('request.index') }}">Medical Tourism</a>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="{{ route('request.index') }}">
                                            Educational Tourism</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="{{ route('website.blog.index') }}">Blogs</a>
                            </li>
                            <li class="submenu">
                                <a href="{{ route('contact.index') }}">Contact Us</a>
                            </li>
                            <li class="submenu">
                                <a href="{{ route('about-us.index') }}">About Us</a>
                            </li>
                            <li class="search-main">
                                <a href="#search1" class="mt_search"><i class="fa fa-search"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="register-login d-flex align-items-center">
                        <!-- <a href="#" class="nir-btn nir-btn-outline me-2">Book Now</a> -->
                        <a href="{{ route('request.index') }}" class="nir-btn white">Book Now</a>
                    </div>

                    <div id="slicknav-mobile"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
    <!-- Navigation Bar Ends -->
</header>
