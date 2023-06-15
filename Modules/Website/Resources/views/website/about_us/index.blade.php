@extends('website::website.layouts.master')

@section('content')
    <!-- BreadCrumb Starts -->
    <section class="breadcrumb-main no-radius pt-8 pb-8"
        style="
        background-image: url(images/tourism1.webp);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
      ">
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1 class="mb-3 fs-2">عن الشركة</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                عن الشركة
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->

    <!-- about-us starts -->
    <section class="about-us pt-6"
        style="
        background-image: url(images/background_pattern.png);
        background-position: bottom right;
      ">
        <div class="container">
            <div class="about-image-box">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-lg-6 ps-4">
                        <div class="about-content text-center text-lg-start">
                            <h4 class="theme d-inline-block mb-0">أسرار الطيار</h4>
                            <h2 class="border-b mb-2 pb-1">نبذة عن تاريخ الشركة</h2>
                            <p class="border-b mb-2 pb-2">
                                تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                                الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم
                                أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                                البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار
                                الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                                البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار
                                الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                                البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                            </p>
                            <div class="about-listing">
                                <ul class="d-flex justify-content-between">
                                    <li class="fs-14">
                                        <i class="fa fa-binoculars theme me-1"></i> باقات متميزة
                                    </li>
                                    <li class="fs-14">
                                        <i class="fa fa-dollar-sign me-1"></i> أسعار تنافسية
                                    </li>
                                    <li class="fs-14">
                                        <i class="fa fa-shield-alt me-1"></i> ثقة و مصداقية
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 pe-4">
                        <div class="about-image" style="animation: none; background: transparent">
                            <img src="{{ asset('website') }}/images/travel.png" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Counter -->
                        <div class="counter-main w-75 float-start z-index3 position-relative">
                            <div class="counter p-4 pb-0 box-shadow bg-white rounded mt-minus">
                                <div class="row">
                                    @foreach ($statistics as $statistic)
                                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                            <div class="counter-item border-end pe-4">
                                                <div class="counter-content">
                                                    <h2 class="value mb-0 theme">
                                                        {{ $statistic->translations->first()->number }}</h2>
                                                    <span
                                                        class="m-0">{{ $statistic->translations->first()->title }}</span>
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
                                        <img src="{{ asset('website') }}/images/icons/easy.svg" alt="Easy"
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
                                        <img src="{{ asset('website') }}/images/icons/trust.svg" alt="Trusted"
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
                                        <img src="{{ asset('website') }}/images/icons/customer-review.svg" alt="Review"
                                            width="70" />
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
                                        <img src="{{ asset('website') }}/images/icons/customer-service.svg"
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
                        <img src="{{ asset('website') }}/images/travel2.png" alt="" />
                    </div>
                </div>
                <div class="col-lg-7 ps-4">
                    <div class="row review-slider">
                        <div class="col-sm-4 item">
                            <div class="testimonial-item1 rounded">
                                <div class="author-info d-flex align-items-center mb-4">
                                    <img src="{{ asset('website') }}/images/og-icon.jpg" alt="" />
                                    <div class="author-title ms-3">
                                        <h5 class="m-0 theme">أحمد على محمد</h5>
                                        <span>عميل دائم</span>
                                    </div>
                                </div>
                                <div class="details">
                                    <p class="m-0">
                                        <i class="fa fa-quote-left me-2 fs-1"></i>Lorem Ipsum is
                                        تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق
                                        و الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل
                                        الأسعار تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران
                                        والفنادق و الرحلات البحرية و التأشيرات و الرخص الدولية
                                        بأفضل الأسعار
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 item">
                            <div class="testimonial-item1 rounded">
                                <div class="author-info d-flex align-items-center mb-4">
                                    <img src="{{ asset('website') }}/images/og-icon.jpg" alt="" />
                                    <div class="author-title ms-3">
                                        <h5 class="m-0 theme">أحمد على محمد</h5>
                                        <span>عميل دائم</span>
                                    </div>
                                </div>
                                <div class="details">
                                    <p class="m-0">
                                        <i class="fa fa-quote-left me-2 fs-1"></i>Lorem Ipsum is
                                        تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق
                                        و الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل
                                        الأسعار تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران
                                        والفنادق و الرحلات البحرية و التأشيرات و الرخص الدولية
                                        بأفضل الأسعار
                                    </p>
                                </div>
                            </div>
                        </div>
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
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 1" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 2" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 3" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 4" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 5" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 6" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 7" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website') }}/images/logo.jpg" alt="Partner 8" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- partner ends -->
@endsection
