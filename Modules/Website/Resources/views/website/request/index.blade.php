@extends('website::website.layouts.master')
@section('content')
    <!-- BreadCrumb Starts -->
    <section class="breadcrumb-main no-radius pb-8 pt-8"
        style="
        background-image: url(images/tourism1.webp);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
      ">
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1 class="mb-3 fs-2">حجز الخدمات</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">الخدمات</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                املأ البيانات لتسجيل الحجز
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->

    <section class="trending pt-8 pb-5 bg-lgrey">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="payment-book">
                        <div class="booking-box">
                            <div class="message-box mb-4">
                                @if (session()->has('success'))
                                    <div
                                        class="alert alert-success text-success rounded-2 px-4 py-1 d-flex justify-content-start align-items-center mb-2">
                                        <i class="far fa-check-circle me-2"></i>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div
                                        class="alert alert-danger text-danger rounded-2 px-4 py-1 d-flex justify-content-start align-items-center mb-2">
                                        <i class="far fa-times-circle me-2"></i>
                                        <span>{{ $errors->first() }} </span>
                                    </div>
                                @endif
                            </div>
                            <div class="customer-information mb-4">
                                <h4 class="border-b pb-4 mb-4">بيانات الحجز / طلب اتصال</h4>
                                <form class="mb-2" action="{{ route('request.store') }}">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-2">
                                                <label>اللقب</label>
                                                <div class="input-box">
                                                    <select class="niceSelect" name="title">
                                                        <option value="0">-- اختر اللقب --</option>
                                                        <option value="MR">Mr.</option>
                                                        <option value="MRs">Mrs.</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-2">
                                                <label>الإسم الأول</label>
                                                <input type="text" placeholder="ادخل الإسم الأول" name="first_name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-2">
                                                <label>الإسم الأخير</label>
                                                <input type="text" placeholder="ادخل الإسم الأخير" name="last_name" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label>البريد الإلكترونى</label>
                                                <input type="email" name="email" placeholder="ادخل البريد الإلكترونى" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label>رقم الموبايل</label>
                                                <input type="text" placeholder="ادخل الموبايل / الواتساب"
                                                    name="phone" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الجنس / النوع</label>
                                                <div class="input-box">
                                                    <select class="niceSelect" name="sex">
                                                        <option value="0">اختر النوع</option>
                                                        <option value="male">ذكر</option>
                                                        <option value="female">أنثى</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label>تاريخ الميلاد</label>
                                                <div class="input-box">
                                                    <input id="date-range" type="date" value="{{ date('Y-m-d') }}"
                                                        name="dob" />
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="border-b pb-4 my-4">بيانات الحجز</h4>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الخدمة المطلوبة</label>
                                                <div class="input-box">
                                                    <select class="niceSelect" name="service">
                                                        <option value="0">اختر الخدمة</option>
                                                        <option value="flight booking">حجز طيران</option>
                                                        <option value="cruise booking">رحلات بحرية</option>
                                                        <option value="international licences">رخص دولية</option>
                                                        <option value="visa">تأشيرات</option>
                                                        <option value="medical tourism">السياحة العلاجية</option>
                                                        <option value="educational tourism">السياحة التعليمية</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label>تاريخ الحجز</label>
                                                <div class="input-box">
                                                    <input id="date-range" type="date" value="{{ date('Y-m-d') }}"
                                                        name="service_date" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>تفاصيل الحجز</label>
                                                <div class="input-box">
                                                    <textarea name="service_details" id="msg" rows="5" placeholder="ادخل تفاصيل الحجز"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="nir-btn float-lg-end w-25">تأكيد الحجز</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Discount action starts -->
    <section class="discount-action pt-6 px-3"
        style="
        background: linear-gradient(to bottom, #ffffff90, #ffffff9f),
          url(images/bg-banner-1.jpg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
      ">
        <div class="section-shape section-shape1 top-inherit bottom-0" style="background-image: url(images/shape8.png)">
        </div>
        <div class="container">
            <div class="call-banner rounded pt-10 pb-14">
                <div class="call-banner-inner w-75 mx-auto text-center px-5">
                    <div class="trend-content-main">
                        <div class="trend-content mb-4 px-md-5 px-4">
                            <h5 class="mb-1 theme">شركة أسرار الطيار</h5>
                            <h2>
                                <a href="detail-fullwidth.html">اكتشف نفسك !!
                                    <span class="theme1">
                                        سافر لأى مكان تريده حوال العالم</span></a>
                            </h2>
                            <p>
                                تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                                الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار
                            </p>
                        </div>
                        <div class="video-button text-center position-relative">
                            <div class="text-center">
                                <a href="#" type="button" class="play-btn nir-btn">
                                    <i class="fa fa-plane me-1"></i>
                                    <span>استكشف العروض</span>
                                </a>
                            </div>
                            <div class="video-figure"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="white-overlay"></div>
    </section>
    <!-- Discount action Ends -->

    <!-- about-us starts -->
    <section class="about-us pb-0 pt-10 px-3"
        style="
        background-image: url(images/shape4.png);
        background-position: center;
      ">
        <div class="container">
            <div class="row align-items-center d-flex">
                <div class="col-lg-6 mb-4">
                    <div class="section-title">
                        <h4 class="mb-1 theme1">لماذا تختار أسرار الطيار ؟</h4>
                        <h2 class="mb-4">أفضل شركة خدمات سياحية داخل مصر</h2>
                        <p class="mb-4">
                            تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و
                            الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار تقدم
                            أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات
                            البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار تقدم أسرار
                            الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات البحرية
                            و التأشيرات و الرخص الدولية بأفضل الأسعار
                        </p>
                        <a href="{{ route('website.index') }}" class="nir-btn">المزيد عن الشركة</a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <!-- why us starts -->
                    <div class="why-us">
                        <div class="why-us-box">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="why-us-item text-center p-4 py-5 border rounded bg-white">
                                        <div class="why-us-content">
                                            <div class="why-us-icon mb-3">
                                                <img src="{{ asset('website') }}/images/icons/easy.svg" alt="Easy" width="70" />
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
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                        <div class="why-us-content">
                                            <div class="why-us-icon mb-3">
                                                <img src="{{ asset('website') }}/images/icons/trust.svg" alt="Trusted" width="70" />
                                            </div>
                                            <h4>
                                                <a href="#">الثقة و المصداقية</a>
                                            </h4>
                                            <p class="mb-0 fs-14">
                                                أسرار الطيار هي شركة موثوق بها من قبل جميع عملائها ،
                                                اكتشف الشهادات.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
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
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                        <div class="why-us-content">
                                            <div class="why-us-icon mb-3">
                                                <img src="{{ asset('website') }}/images/icons/customer-service.svg" alt="customer service"
                                                    width="70" />
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
            </div>
        </div>
        <div class="white-overlay"></div>
    </section>
    <!-- about-us ends -->

    <!-- partner starts -->
    <section class="our-partner pb-6 pt-6 px-3">
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
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 1" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 2" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 3" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 4" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 5" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 6" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 7" />
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('website/images') }}/logo.jpg" alt="Partner 8" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- partner ends -->
@endsection
