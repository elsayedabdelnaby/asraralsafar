@extends('website::website.website.layouts.master')
@section('content')
    <!-- BreadCrumb Starts -->
    <section
      class="breadcrumb-main no-radius pb-8 pt-8"
      style="
        background-image: url(images/tourism1.webp);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
      "
    >
      <div class="breadcrumb-outer">
        <div class="container">
          <div class="breadcrumb-content text-center">
            <h1 class="mb-3 fs-3">رحلة إلى شرم الشيخ ، 6 ليالى</h1>
            <nav aria-label="breadcrumb" class="d-block">
              <ul class="breadcrumb">
                <li class="breadcrumb-item">
                  <a class="text-white" href="#">الرئيسية</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="text-white" href="#">الباقات و العروض</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('website::website.journy to') }} {{ $package->title }} {{ $package->number_of_days }}
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->

    <!-- top Destination starts -->
    <section class="trending pt-10 pb-10 bg-lgrey">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="single-content">
              <div id="highlight">
                <div class="single-full-title border-b mb-2 pb-2">
                  <div class="single-title">
                    <h2 class="mb-1 fs-3">{{ __('website::website.journy to') }} {{ $package->title }} {{ $package->number_of_days }}</h2>
                    <div class="rating-main d-md-flex align-items-center">
                      <p class="mb-0 me-2">
                        <i class="icon-location-pin"></i> {{ $package->title }}, {{ $package->country->load('translations')->display_name }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="description-images mb-4">
                  <img
                    src="{{ asset("storage/website/$package->image") }}"
                    alt=""
                    class="w-100 rounded"
                  />
                </div>

                <div class="description mb-2">
                  <h4>تفاصيل الباقة / العرض</h4>
                  <p>{{ $package->description }}</p>
                </div>

                <div class="tour-includes mb-4">
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <i
                            class="far fa-clock-o pink mr-1"
                            aria-hidden="true"
                          ></i>
                          {{ $package->number_of_days }} {{ __('website::website.days') }}
                        </td>
                        <td>
                          <i
                            class="fa fa-group pink mr-1"
                            aria-hidden="true"
                          ></i>
                          {{ __('website::website.number_of_clients') }} {{ $package->number_of_clients }}
                        </td>
                        <td>
                          <i
                            class="far fa-calendar pink mr-1"
                            aria-hidden="true"
                          ></i>
                          {{ Carbon\Carbon::parse($package->traveling_date)->format('d M') }} - {{ Carbon\Carbon::parse($package->return_date)->format('d M') }}
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i
                            class="fa fa-dollar pink mr-1"
                            aria-hidden="true"
                          ></i>
                          {{ $package->price }} $
                        </td>
                        <td>
                          <i
                            class="fa fa-pizza-slice pink me-1"
                            aria-hidden="true"
                          ></i>
                          {{ $package->number_of_meals }} {{ __('website::website.number_of_meals') }}
                        </td>
                        <td>
                          <i
                            class="fa fa-wifi pink mr-1"
                            aria-hidden="true"
                          ></i>
                          {{ __('website::website.free_wifi') }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="description mb-2">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 mb-2">
                      <div class="desc-box bg-grey p-4 rounded">
                        <h5 class="mb-2">{{ __('website::website.traveling_location') }}</h5>
                        <p class="mb-0">{{ $package->traveling_location }}</p>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                      <div class="desc-box bg-grey p-4 rounded">
                        <h5 class="mb-2">{{ __('website::website.rooms') }}</h5>
                        <p class="mb-0">{{ $package->type_of_rooms }}</p>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                      <div class="desc-box bg-grey p-4 rounded">
                        <h5 class="mb-2"> {{ __('website::website.meeting_time') }}</h5>
                        <p class="mb-0">{{ $package->meeting_time }}</p>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-2">
                      <div class="desc-box bg-grey p-4 rounded">
                        <h5 class="mb-2"> {{ __('website::website.departure_time') }}</h5>
                        <p class="mb-0">{{ $package->departure_time }}</p> 
                      </div>
                    </div>
                    <div class="col-12 mb-2">
                      <div class="desc-box bg-grey p-4 rounded">
                        <h5 class="mb-2"> {{ __('website::website.price_includes') }} </h5> 
                        <ul>
                            @foreach (json_decode($package->price_includes) as $item)
                            <li class="d-block pb-1">
                                <i class="fa fa-check pink mr-1"></i> {{ $item }}
                              </li>
                            @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="single-map" class="single-map mb-4">
                <h4>موقع الإقامة</h4>
                <div class="map rounded overflow-hidden">
                  <div style="width: 100%">
                    <iframe
                      class="rounded overflow-hidden"
                      height="400"
                      src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=+(mangal%20bazar)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    ></iframe>
                  </div>
                </div>
              </div>
              <!-- blog review -->
              <div class="action">
                <div class="form-btn">
                  <a href="#" class="nir-btn">احجز مكانك الآن</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 ps-lg-4">
            <div class="sidebar-sticky sticky1">
              <div
                class="tabs-navbar bg-lgrey mb-4 bordernone rounded overflow-hidden"
              >
                <div class="row">
                  <div class="col-md-12">
                    <ul id="tabs" class="nav nav-tabs bordernone mb-0">
                      <li class="active">
                        <a
                          data-toggle="tab"
                          href="#highlight"
                          class="rounded box-shadow mb-2 border-all"
                        >
                          <i class="far fa-check-circle me-2"></i>
                          تفاصيل الرحلة</a
                        >
                      </li>
                      <li>
                        <a
                          data-toggle="tab"
                          href="#iternary"
                          class="rounded box-shadow mb-2 border-all"
                        >
                          <i class="far fa-check-circle me-2"></i>
                          برنامج الرحلة</a
                        >
                      </li>
                      <li>
                        <a
                          data-toggle="tab"
                          href="#single-map"
                          class="rounded box-shadow mb-2 border-all"
                        >
                          <i class="far fa-check-circle me-2"></i>
                          الموقع</a
                        >
                      </li>
                      <li>
                        <a
                          data-toggle="tab"
                          href="request.booking.rtl.html"
                          class="rounded box-shadow mb-2 border-all"
                        >
                          <i class="far fa-paper-plane me-2"></i>
                          احجز الآن (400 $)</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- top Destination ends -->

    <!-- Discount action starts -->
    <section
      class="discount-action pt-6"
      style="
        background: linear-gradient(to bottom, #ffffff90, #ffffff9f),
          url(images/bg-banner-1.jpg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
      "
    >
      <div
        class="section-shape section-shape1 top-inherit bottom-0"
        style="background-image: url(images/shape8.png)"
      ></div>
      <div class="container">
        <div class="call-banner rounded pt-10 pb-14">
          <div class="call-banner-inner w-75 mx-auto text-center px-5">
            <div class="trend-content-main">
              <div class="trend-content mb-4 px-md-5 px-4">
                <h5 class="mb-1 theme">شركة أسرار الطيار</h5>
                <h2>
                  <a href="detail-fullwidth.html"
                    >اكتشف نفسك !!
                    <span class="theme1">
                      سافر لأى مكان تريده حوال العالم</span
                    ></a
                  >
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
                  <img src="images/logo.jpg" alt="Partner 1" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 2" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 3" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 4" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 5" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 6" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 7" />
                </li>
                <li class="mb-2">
                  <img src="images/logo.jpg" alt="Partner 8" />
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- partner ends -->
    @endsection