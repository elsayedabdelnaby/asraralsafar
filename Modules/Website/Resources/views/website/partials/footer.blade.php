<footer class="pt-10 pb-4" style="background-image: url(images/background_pattern.png)">
    <div class="footer-upper text-md-start text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 pe-4">
                    <div class="footer-about">
                        <img class="rounded-pill" src="{{ global_asset("storage/website/$websiteInfo->footer_logo") }}"
                            width="200" alt="" />
                        <p class="mt-3 mb-3 white fs-14">
                            تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات البحرية و التأشيرات و
                            الرخص الدولية بأفضل الأسعار تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                            الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                        </p>
                        <ul>
                            @foreach ($phoneNumbers as $phoneNumber)
                                <li class="text-white d-block">
                                    <img class="me-1" width="20"
                                        src="{{ global_asset('website/images/icons/phone.svg') }}" alt="phone" />
                                    <a href="tel:({{ $phoneNumber?->value }})"
                                        class="text-white fs-14">{{ $phoneNumber?->value }}</a>
                                </li>
                            @endforeach
                            <li class="text-white d-block">
                                <img class="me-1" width="20"
                                    src="{{ global_asset('website/images/icons/location.svg') }}" alt="location" />
                                <span class="fs-14">
                                    {{ $websiteInfo->translations()->where('language_id', getCurrentLanguage()->id)->first()->address }}
                                </span>
                            </li>
                            <li class="text-white d-block">
                                <img class="me-1" width="20"
                                    src="{{ global_asset('website/images/icons/message.svg') }}" alt="mail" />
                                <a href="mailto:{{ $infoMail?->value }}"
                                    class="text-white fs-14">{{ $infoMail?->value }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white"></h3>
                        <ul>
                            <li><a href="{{ route('flight.index') }}"> @lang('website.Book A Flight')</a></li>
                            <li><a href="{{ route('website.index') }}"> @lang('website.International Licensing')</a></li>
                            <li><a href="{{ route('website.index') }}"> @lang('website.Visa')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white"></h3>
                        <ul>
                            <li><a href="{{ route('about-us.index') }}"> @lang('website.About Us')</a></li>
                            <li><a href="{{ route('contact.index') }}"> @lang('website.Contact Us')</a></li>
                            <li><a href="{{ route('website.index') }}"> @lang('website.FAQ')</a></li>
                            <li><a href="{{ route('website.index') }}"> @lang('website.Privacy Policy')</a></li>
                            <li><a href="{{ route('website.index') }}"> @lang('website.Terms & Conditions')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="footer-links">
                        <h3 class="white">@lang('website.Newsletter')</h3>
                        <div class="newsletter-form">
                            <p class="mb-3">
                                @lang('website.Join our community of over 200,000 global readers who receives emails filled with news, promotions, and other good stuff.')
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
                                            @lang('website.Subscribe')
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
                        @lang('website.2023 Asrar Altayar.') &copy; @lang('website.All rights reserved.')
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
