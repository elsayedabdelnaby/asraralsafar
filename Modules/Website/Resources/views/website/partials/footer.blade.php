<footer class="pt-10 pb-4" style="background-image: url(images/background_pattern.png)">
    <div class="footer-upper text-md-start text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 pe-4">
                    <div class="footer-about">
                        <img class="rounded-pill" src="{{global_asset("storage/website/$websiteInfo->footer_logo") }}"
                            width="200" alt="" />
                        <p class="mt-3 mb-3 white fs-14">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio
                            suspendisse leo neque iaculis molestie sagittis maecenas
                            aenean eget molestie sagittis.
                        </p>
                        <ul>
                            <li class="text-white d-block">
                                <img class="me-1" width="20" src="{{global_asset('website/images/icons/phone.svg') }}"
                                    alt="phone" />
                                <a href="tel:({{ $phoneNumber?->value }})"
                                    class="text-white fs-14">{{ $phoneNumber?->value }}</a>
                            </li>
                            <li class="text-white d-block">
                                <img class="me-1" width="20"
                                    src="{{global_asset('website/images/icons/location.svg') }}" alt="location" />
                                <span class="fs-14">
                                    12/13 A Dokki Tahrir ,Cairo, Egypt
                                </span>
                            </li>
                            <li class="text-white d-block">
                                <img class="me-1" width="20" src="{{global_asset('website/images/icons/message.svg') }}"
                                    alt="mail" />
                                <a href="mailto:{{ $infoMail?->value }}"
                                    class="text-white fs-14">{{ $infoMail?->value }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Quick link</h3>
                        <ul>
                            <li><a href="{{ route('package.index') }}">Packages</a></li>
                            <li><a href="{{ route('package.index') }}">Offers</a></li>
                            <li><a href="{{ route('cruise.index') }}">Book A Cruise</a></li>
                            <li><a href="{{ route('flight.index') }}">Book A Flight</a></li>
                            <li><a href="{{ route('website.index') }}">International Licensing</a></li>
                            <li><a href="{{ route('website.index') }}">Visa</a></li>
                            <li><a href="{{ route('website.index') }}">Blogs & News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Pages</h3>
                        <ul>
                            <li><a href="{{ route('about-us.index') }}">About Us</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                            <li><a href="{{ route('website.index') }}">FAQ</a></li>
                            <li><a href="{{ route('website.index') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('website.index') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('website.index') }}">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">Newsletter</h3>
                        <div class="newsletter-form">
                            <p class="mb-3">
                                Jin our community of over 200,000 global readers who
                                receives emails filled with news, promotions, and other good
                                stuff.
                            </p>
                            <div class="row g-2">
                                @if (session()->has('message'))
                                    <div class="alert alert-info" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <form action="{{ route('subscription.store') }}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <input type="email" placeholder="Email Address" name="email" />
                                    </div>
                                    <div class="col-12">
                                        <button class="nir-btn no-shadow w-100" type="submit">
                                            <i class="fa fa-envelope me-1"></i>
                                            Subscribe
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="copyright-inner rounded p-3 d-md-flex align-items-center justify-content-between">
                <div class="copyright-text">
                    <p class="m-0 white fs-14">
                        2023 Asrar Altayar. &copy; All rights reserved.
                    </p>
                </div>
                <div class="social-links">
                    <ul>
                        @foreach ($socialLinks as $link)
                            <li>
                                <a href="{{ $link->url }}" class="white" target="_blank">
                                    <img src="{{ $link->icon_url }}" alt="social" />
                                </a>
                            </li>
                        @endforeach
                        {{-- <li>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
              </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
