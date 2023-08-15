@extends('website::website.layouts.master')

@section('content')
    <!-- BreadCrumb Starts -->
    <section class="breadcrumb-main pb-8 pt-8 no-radius"
        style="
        background-image: url(images/tourism1.webp);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
      ">
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1 class="mb-3 fs-2">@lang('website.cruise_page_title')</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">@lang('website.home')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('website.cruise_reservation')
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
    <section class="trending pt-8 bg-lgrey px-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="cruise-list">
                        <div class="cruise-full">
                            @foreach ($cruises as $cruise)
                                <div class="trend-full bg-white rounded box-shadow overflow-hidden p-4 mb-4">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="trend-item2 rounded">
                                                <a href="#"
                                                    style="
background-image: url({{ global_asset('website') }}/images/destination/d1.jpg);
background-size: cover;
background-repeat: no-repeat;
"></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <div class="trend-content">
                                                <p class="mb-0"> {{ $cruise->name }}</p>
                                                <h4 class="mb-2 border-b pb-2">
                                                    <a href="#" class=""> {{ $cruise->description }}
                                                    </a>
                                                </h4>
                                                <ul
                                                    class="featured-meta border-b pb-2 mb-2 d-flex flex-sm-row flex-column gap-3 align-items-center justify-content-between">
                                                    <li>
                                                        <strong class="d-block"> @lang('website.trip_date')</strong>
                                                        {{ $cruise->date }}
                                                    </li>
                                                    <li>
                                                        <strong class="d-block"> @lang('website.departure')</strong>
                                                        {{ $cruise->take_off_location }}
                                                    </li>
                                                </ul>

                                                <div
                                                    class="entry-author d-flex flex-sm-row flex-column align-items-center justify-content-between gap-3">
                                                    <a href="#" class="nir-btn-black py-1">@lang('website.book_now')</a>
                                                    <p class="mb-0">
                                                        @lang('website.starting_from') :
                                                        <span class="theme fw-bold fs-6">{{ $cruise->start_from_price }}
                                                            {{ getCurrentLanguage()->id == 1 ? 'EGP' : 'ج.م' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="theme-pagination d-flex justify-content-center mt-5">
                            <ul class="pagination d-flex flex-wrap gap-2">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-angle-left mirror-ar"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $cruises->lastPage(); $i++)
                                    <li class="{{ $cruises->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $cruises->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-angle-right mirror-ar"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ps-lg-4">
                    <div class="sidebar-sticky">
                        <div class="list-sidebar">
                            <div class="sidebar-item mb-4">
                                <div class="book-form w-100 bg-white box-shadow p-4 pb-1 z-index1 rounded">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-lg-12">
                                            <h3>@lang('website.data_search')</h3>
                                        </div>
                                        <form action="{{ route('cruise.index') }}" method="GET">
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <div class="input-box">
                                                        <label>@lang('website.search')</label>
                                                        <input type="text" placeholder="@lang('website.enter_search_key')"
                                                            name="search" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <div class="input-box">
                                                        <label>@lang('website.destination')</label>
                                                        <select class="niceSelect" name="country_id">
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">
                                                                    {{ $country->display_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <div class="input-box">
                                                        <label>@lang('website.trip_date')</label>
                                                        <input type="date" name="date"
                                                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <div class="input-box">
                                                        <label>@lang('website.number_of_individuals')</label>
                                                        <select class="niceSelect">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="3">4</option>
                                                            <option value="3">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <div class="input-box">
                                                        <label>@lang('website.number_of_rooms')</label>
                                                        <select class="niceSelect">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-0 text-center">
                                                    <button href="#" class="nir-btn w-100" type="submit"><i
                                                            class="fa fa-search me-2 mirror-ar"></i>
                                                        @lang('website.search_trips')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-item mb-4">
                                <h4 class="">@lang('website.trip_price')</h4>
                                <div class="range-slider mt-0">
                                    <div data-min="0" data-max="20000" data-unit="$" data-min-name="min_price"
                                        data-max-name="max_price"
                                        class="range-slider-ui ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                        aria-disabled="false">
                                        <span class="min-value">0 EGP</span>
                                        <span class="max-value">20000 EGP</span>
                                        <div class="ui-slider-range ui-widget-header ui-corner-all full"
                                            style="left: 0%; width: 100%"></div>
                                    </div>
                                    <div class="clearfix"></div>
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
                            <h5 class="mb-1 theme">@lang('website.company_name')</h5>
                            <h2>
                                <a href="#">@lang('website.discover_yourself') !!
                                    <span class="theme1">
                                        @lang('website.travel_anywhere')</span></a>
                            </h2>
                            <p>
                                @lang('website.secret_pilot_services')
                            </p>
                        </div>
                        <div class="video-button text-center position-relative">
                            <div class="text-center">
                                <a href="#" type="button" class="play-btn nir-btn">
                                    <i class="fa fa-plane me-1"></i>
                                    <span>@lang('website.explore_offers')</span>
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
                        <h4 class="mb-1 theme1">@lang('website.why_choose_pilot_secrets')</h4>
                        <h2 class="mb-4">@lang('website.best_tourism_services')</h2>
                        <p class="mb-4">
                            @lang('website.pilot_secret_services_description')
                        </p>
                        <a href="{{ route('website.index') }}" class="nir-btn">@lang('website.more_about_company')</a>
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
                                                <img src="{{ global_asset('website') }}/images/icons/easy.svg"
                                                    alt="Easy" width="70" />
                                            </div>
                                            <h4>
                                                <a href="#">@lang('website.ease_and_flexibility')</a>
                                            </h4>
                                            <p class="mb-0 fs-14">
                                                @lang('website.book_your_trip_easily_online').
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                        <div class="why-us-content">
                                            <div class="why-us-icon mb-3">
                                                <img src="{{ global_asset('website') }}/images/icons/trust.svg"
                                                    alt="Trusted" width="70" />
                                            </div>
                                            <h4>
                                                <a href="#">@lang('website.trust_and_credibility')</a>
                                            </h4>
                                            <p class="mb-0 fs-14">
                                                @lang('website.secret_pilot_trusted_by_all_clients').
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                        <div class="why-us-content">
                                            <div class="why-us-icon mb-3">
                                                <img src="{{ global_asset('website') }}/images/icons/customer-review.svg"
                                                    alt="Review" width="70" />
                                            </div>
                                            <h4>
                                                <a href="#">@lang('website.customer_focus')</a>
                                            </h4>
                                            <p class="mb-0 fs-14">
                                                @lang('website.pilot_secret_focuses_on_customer_satisfaction').
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                        <div class="why-us-content">
                                            <div class="why-us-icon mb-3">
                                                <img src="{{ global_asset('website') }}/images/icons/customer-service.svg"
                                                    alt="customer service" width="70" />
                                            </div>
                                            <h4>
                                                <a href="#">@lang('website.24_7_support')</a>
                                            </h4>
                                            <p class="mb-0 fs-14">
                                                @lang('website.pilot_secret_supports_customers_24_7').
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
    <section class="our-partner pb-6 pt-6">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">@lang('website.our partners')</h4>
                <h2 class="mb-1">
                     @lang('website.know about') <span class="theme">@lang('website.our parteners')</span>
                </h2>
                <p>
                    @lang('website.asrar altayran represents services of electronic reservations for flights , hotels , visa and international licencses')
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
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Function to filter flights based on selected options
            function filterCruises() {
                var priceRange = $('.range-slider-ui').slider('values');

                // Prepare the data to be sent via AJAX
                var data = {
                    min_price: priceRange[0],
                    max_price: priceRange[1]
                };

                // Send AJAX request to update the flight list
                $.ajax({
                    url: "{{ route('cruise.index') }}",
                    method: 'GET',
                    data: data,
                    success: function(response) {
                        // Get the new flight list JSON
                        $('.cruise-full').html(response);
                    }
                });
            }

            $('.range-slider-ui').on('slidechange', function(event, ui) {
                var minPrice = ui.values[0];
                var maxPrice = ui.values[1];

                $('#my-form').append("<input type='hidden' name='min_price' value='" + minPrice + "'/>");
                $('#my-form').append("<input type='hidden' name='max_price' value='" + maxPrice + "'/>");

                filterCruises();
            });
        });
    </script>
@endpush
