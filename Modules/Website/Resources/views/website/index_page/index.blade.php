@extends('website::website.layouts.master')

@if (!empty($metaPage))
    @php
        $metaPageTitle = !empty($metaPage->first()->meta_page_title) ? $metaPage->first()->meta_page_title : '';
        $metaPageDescription = !empty($metaPage->first()->meta_page_description) ? $metaPage->first()->meta_page_description : '';
        $imageUrl = !empty($metaPage->first()->image_url) ? $metaPage->first()->image_url : '';

    @endphp
    @section('meta_page')
        <meta property="og:title" content="{{ $metaPageTitle }}">
        <meta property="og:description" content="{{ $metaPageDescription }}">
        <meta name="description" content="{{ $metaPageDescription }}">
        <meta property="og:image" content="{{ $imageUrl }}">
    @endsection
@endif

@section('content')
    <div class="tet"></div>

    <!-- banner starts -->
    <section class="banner pt-10 pb-0 overflow-hidden"
        style="
       background: linear-gradient(
           to bottom left,
           #ffffffc6,
           #ffffffc6,
           #d5dfffcd
         ),
         url(images/tourism2.jpg);
       background-size: cover;
       background-repeat: no-repeat;
     ">
        <div class="container">
            <div class="banner-in">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4">
                        <div class="banner-content text-lg-start text-center">
                            <h4 class="theme mb-0">شاهد العالم من خلالنا</h4>
                            <h1 class="text-success fs-38">
                                ابدأ التخطيط لرحلة أحلامك اليوم!
                            </h1>
                            <p class="mb-4">
                                تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                                الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                            </p>
                            <form method="GET" action="{{ route('request.index') }}">
                                @csrf
                                @method('GET')
                                <div class="book-form">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-12 mb-2">
                                            <div class="form-group">
                                                <div class="input-box">
                                                    <select class="niceSelect" name="service">
                                                        <option value="" disabled>اختر الخدمة</option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->slug }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-0 text-center">
                                                <button type="submit" class="nir-btn w-100">
                                                    <i class="fa fa-search me-2"></i>
                                                    ابحث /
                                                    طلب التواصل
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="banner-image">
                            <img src="{{ global_asset('website/') }}/images/travel.png" alt="travel" />
                        </div>
                    </div>
                </div>
                <div class="category-main-inner border-t pt-1 mb-4">
                    <div class="row d-flex justify-content-center g-4">
                        @foreach ($services as $service)
                            <div class="col-xl-2 col-lg-4 col-md-6">
                                <div class="category-item box-shadow p-3 py-4 text-center bg-white rounded overflow-hidden">
                                    <div class="trending-topic-content">
                                        <img width="20" src="{{ $service->image_url }}" class="mb-1 d-inline-block"
                                            alt="Book Hotel" />
                                        <h4 class="mb-0 fs-18">
                                            <a
                                                href="{{ route('website.services.show', $service->slug) }}">{{ $service->name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-us ends -->

    <!-- about-us starts -->
    <section class="about-us pb-6 pt-6"
        style="
        background-image: url(images/shape4.png);
        background-position: center;
      ">
        <div class="container">
            <div class="section-title mb-6 w-50 mx-auto text-center">
                <h4 class="mb-1 theme1">أسرار الطيار</h4>
                <h2 class="mb-1">
                    <span class="theme">إختيارك الأمثل فى مصر</span>
                </h2>
                <p>
                    تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                    البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                </p>
            </div>

            <!-- why us starts -->
            <div class="why-us">
                <div class="why-us-box">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ global_asset('website/') }}/images/icons/easy.svg" alt="Easy"
                                            width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">السهولة و المرونة</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        يمكنك إجراء الحجز الخاص بك بسهولة من خلال موقعنا على
                                        الإنترنت.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ global_asset('website/') }}/images/icons/trust.svg" alt="Trusted"
                                            width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">الثقة و المصداقية</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        أسرار الطيار هي شركة موثوق بها من قبل جميع عملائها ، اكتشف
                                        الشهادات.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ global_asset('website/') }}/images/icons/customer-review.svg"
                                            alt="Review" width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">التركيز على العميل</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        أسرار الطيار تركز بشكل رئيسي على رضا العميل و سعادة.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ global_asset('website/') }}/images/icons/customer-service.svg"
                                            alt="customer service" width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">دعم 24 ساعة يومياً</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        أسرار الطيار تدعم العملاء 24 ساعة في اليوم & 7 أيام
                                        أسبوعياً.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- why us ends -->
        </div>
        <div class="white-overlay"></div>
    </section>
    <!-- about-us ends -->

    <!-- top Destination starts -->
    <section class="trending pb-5 pt-0">
        <div class="container">
            <div class="section-title mb-6 w-50 mx-auto text-center">
                <h4 class="mb-1 theme1">@lang('website.Trending Destinations')</h4>
                <h2 class="mb-1">
                    @lang('website.Explore') <span class="theme">@lang('website.Top Destinations')</span>
                </h2>
                <p>

                </p>
            </div>
            <div class="row align-items-center">
                @foreach (Modules\Locations\Entities\Country::has('topPackages')->withCount('topPackages')->get()->take(3) as $country)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item1">
                            <div class="trend-image position-relative rounded">
                                <img class="lg" src="{{ $country->topPackageImage($country->topPackages->first()) }}"
                                    alt="destination" />
                                <div
                                    class="trend-content d-flex flex-md-row flex-column align-items-md-center justify-content-md-between align-items-start position-absolute bottom-0 p-4 w-100 z-index">
                                    <div class="trend-content-title">
                                        <h3 class="mb-0 white">{{ $country->country_name }}</h3>
                                    </div>
                                    <span
                                        class="white bg-theme1 fs-12 p-1 px-2 rounded mt-md-0 mt-3 text-center">{{ $country->top_packages_count }}
                                        @lang('Packages')</span>
                                </div>
                                <div class="color-overlay"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="action text-center mt-5">
                    <a class="nir-btn" href="#">
                        <i class="fa fa-plane me-1"></i>
                        @lang('website.View All Destinations')
                    </a>
                </div>
            </div>
    </section>
    <!-- top Destination ends -->

    <!-- about-us starts -->
    <section class="about-us pt-0" style="background-image: url(images/bg/bg-trans.png)">
        <div class="container">
            <div class="about-image-box">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-lg-6 mb-4 pe-4">
                        <div class="about-image overflow-hidden">
                            <img src="{{ global_asset('website/') }}/images/travel1.png" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 ps-4">
                        <div class="about-content text-center text-lg-start mb-4 pb-100">
                            <h4 class="theme d-inline-block mb-0">@lang('website.Get To Know Us')</h4>
                            <h2 class="border-b mb-2 pb-1">
                                @lang('website.Explore All Tour of the world with us.')
                            </h2>
                            <p class="border-b mb-2 pb-2">@lang('website.')
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat.<br /><br />Excepteur
                                sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.
                            </p>
                            <div class="about-listing">
                                <ul class="d-flex justify-content-between">
                                    <li class="fs-14">
                                        <i class="fa fa-binoculars theme me-1"></i> @lang('website.Excellent Packages')
                                    </li>
                                    <li class="fs-14">
                                        <i class="fa fa-dollar-sign me-1"></i> @lang('website.Competitive Prices')
                                    </li>
                                    <li class="fs-14">
                                        <i class="fa fa-shield-alt me-1"></i> @lang('website.Trust & Credibility')
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Counter -->
                        <div class="counter-main w-75 float-end">
                            <div class="counter p-4 pb-0 box-shadow bg-white rounded">
                                <div class="row">
                                    @foreach ($statistics as $statistic)
                                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                            <div class="counter-item border-end pe-4">
                                                <div class="counter-content text-sm-start text-center">
                                                    <h2 class="value mb-0 theme">
                                                        {{ $statistic->number }}</h2>
                                                    <span class="m-0">{{ $statistic->title }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- End Counter -->
                    </div>
                </div>
            </div>
        </div>
        <div class="white-overlay"></div>
    </section>
    <!-- about-us ends -->

    <!-- offer Packages Starts -->
    <section class="trending pb-0 pt-4">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">@lang('website.Top Offers')</h4>
                <h2 class="mb-1">
                    @lang('website.Special') <span class="theme">@lang('website.Offers & Discount') </span> @lang('website.Packages')
                </h2>
                <p>
                    @lang('website.')Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="trend-box">
                <div class="row">
                    @foreach (Modules\Package\Entities\Package::where('is_top', true)->get() as $package)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="trend-item rounded box-shadow bg-white">
                                <div class="trend-image position-relative">
                                    <img src="{{ global_asset("storage/website/$package->image") }}" alt="image"
                                        class="" />
                                    <div class="ribbon ribbon-top-left">
                                        <span class="fw-bold">20% @lang('website.')OFF</span>
                                    </div>
                                    <div class="color-overlay"></div>
                                </div>
                                <div class="trend-content p-4 pt-5 position-relative">
                                    <h5 class="theme mb-1">
                                        <i class="flaticon-location-pin"></i> {{ $package->country->country_name }}
                                    </h5>
                                    <h3 class="mb-1">
                                        <a href="#">{{ $package->title }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- offer Packages Ends -->

    <!-- testomonial start -->
    <section class="testimonial pt-9" style="background-image: url(images/testimonial.png)">
        <div class="container">
            <div class="section-title mb-6 text-center w-75 mx-auto">
                <h4 class="mb-1 theme1">ماذا يقول العملاء عنا ؟</h4>
                <h2 class="mb-1">استكشف آراء <span class="theme">العملاء </span></h2>
                <p>استكشف آراء العملاء ومدى رضائهم عن خدماتنا</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 pe-4">
                    <div class="testimonial-image">
                        <img src="{{ global_asset('website/') }}/images/og-icon.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-7 ps-4">
                    <div class="row review-slider slick-initialized slick-slider"><button class="slick-prev slick-arrow"
                            aria-label="Previous" type="button" style="">Previous</button>
                        <div class="slick-list draggable">
                            <div class="slick-track"
                                style="opacity: 1; width: 3805px; transform: translate3d(2283px, 0px, 0px); transition: transform 2000ms ease 0s;">
                                @foreach ($testimonails as $testimonail)
                                    @if ($loop->first)
                                        <div class="col-sm-4 item slick-slide slick-cloned slick-current slick-active">
                                            <div class="testimonial-item1 rounded">
                                                <div class="author-info d-flex align-items-center mb-4">
                                                    <img src="{{ global_asset('website/') }}/images/og-icon.jpg"
                                                        alt="" />
                                                    <div class="author-title ms-3">
                                                        <h5 class="m-0 theme">{{ $testimonail->client_name }}</h5>
                                                        <span>{{ __('website::website.client') }}</span>
                                                    </div>
                                                </div>
                                                <div class="details">
                                                    <p class="m-0">
                                                        <i
                                                            class="fa fa-quote-left me-2 fs-1"></i>{{ $testimonail->testimonail }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-4 item slick-slide slick-cloned">
                                        <div class="testimonial-item1 rounded">
                                            <div class="author-info d-flex align-items-center mb-4">
                                                <img src="{{ global_asset('website/') }}/images/og-icon.jpg"
                                                    alt="" />
                                                <div class="author-title ms-3">
                                                    <h5 class="m-0 theme">{{ $testimonail->client_name }}</h5>
                                                    <span>{{ __('website::website.client') }}</span>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <p class="m-0">
                                                    <i
                                                        class="fa fa-quote-left me-2 fs-1"></i>{{ $testimonail->testimonail }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="slick-next slick-arrow" aria-label="Next" type="button"
                            style="">@lang('website.next')</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial ends -->

    <!-- partner starts -->
    <section class="our-partner pb-6 pt-6">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">شركاء أسرار الطيار</h4>
                <h2 class="mb-1">
                    تعرف على <span class="theme">شركائنا</span> المميزين
                </h2>
                <p>
                    تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                    البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                </p>
            </div>
            <div class="our-partner p-0">
                <div class="container">
                    <div class="partners_inner">
                        <ul>
                            @foreach ($partners as $partner)
                                <li class="mb-2"><img src="{{ $partner->logo_url }}" alt="Partner" /></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- partner ends -->

    <!-- recent-articles starts -->
    <section class="trending recent-articles pb-6">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">@lang('website.Our Blogs Offers')</h4>
                <h2 class="mb-1">
                    @lang('website.Recent') <span class="theme">@lang('website.Articles & Posts')</span>
                </h2>
                <p>
                    @lang('website.') Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="recent-articles-inner">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6">
                            <div class="trend-item box-shadow bg-white mb-4 rounded overflow-hidden">
                                <div class="trend-image">
                                    <img src="{{ $blog->image_url }}" alt="image" />
                                </div>
                                <div class="trend-content-main p-4 pb-2">
                                    <div class="trend-content">
                                        <h5 class="mb-1 fs-14">{{ $blog->blog_title }}</h5>
                                        <p class="mb-3">
                                            {{ $blog->translation->description }}
                                        </p>
                                        <div class="entry-meta d-flex align-items-center justify-content-between">
                                            <div class="entry-author mb-2">
                                                <img src="{{ global_asset('website/') }}/images/og-icon.jpg"
                                                    alt="" class="rounded-circle me-1" />
                                                <span>@lang('website.Asrar Altayar')</span>
                                            </div>
                                            <div class="entry-button d-flex align-items-centermb-2">
                                                <a href="{{ route('blog.show', $blog->blog_slug) }}"
                                                    class="nir-btn">@lang('website.Read More')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- recent-articles ends -->
@endsection
