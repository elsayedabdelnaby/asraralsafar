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
                    <h1 class="mb-3 fs-2">@lang('website.air_trips')</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">@lang('website.home')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('website.book_air_trips')
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
    <section class="trending pt-6 pb-7 bg-lgrey">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="list-results d-flex align-items-center justify-content-between">
                    </div>

                    <div class="flight-list">
                        <div class="flight-full">
                            @foreach ($flights as $flight)
                                <div class="item mb-2 border-all p-3 px-4 rounded">
                                    <div class="row g-lg-2 g-3 d-flex align-items-center justify-content-between">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="item-inner-image text-start">
                                                <img src="{{ global_asset("storage/website/$flight->image") }}" width="60"
                                                    alt="image" />
                                                <h5 class="mb-0"> {{ $flight->company_name }}</h5>
                                                <small> {{ $flight->from_location }} - {{ $flight->to_location }}</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="item-inner">
                                                <div class="content">
                                                    <h6 class="mb-0">
                                                        {{ $flight->day }}
                                                        <br />
                                                        {{ Carbon\Carbon::parse($flight->traveling_date)->format('d F Y') }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="item-inner">
                                                <div class="content">
                                                    <h5 class="mb-0">{{ $flight->arrival_time }}</h5>
                                                    <p class="mb-0 text-uppercase">{{ $flight->destination_slug }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="item-inner text-end">
                                                <p class="theme2 fs-4 fw-bold fs-18">{{ $flight->price }}
                                                    {{ $flight->price_currency }}</p>
                                                <a href="#" class="nir-btn-black">@lang('website.book_now')</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <hr class="mt-1 mb-1" />
                                        </div>
                                        <div class="col-12">
                                            <ul class="list-inline d-flex flex-wrap">
                                                <li class="list-inline-item">
                                                    <span class="badge bg-danger rounded-2 px-2 fs-12">{{ $flight->type }}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="badge bg-success rounded-2 px-2 fs-12">@lang('website.airbus_320')</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="badge bg-secondary rounded-2 px-2 fs-12">@lang('website.fresh_meals')</span>
                                                </li>
                                            </ul>
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
                                @for ($i = 1; $i <= $flights->lastPage(); $i++)
                                    <li class="{{ $flights->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $flights->url($i) }}" class="page-link">{{ $i }}</a>
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
                                        <form action="{{ route('flight.index') }}" method="GET">
                                            <div class="col-lg-12 mb-2 text-center">
                                                <ul class="pb-2 mb-2 border-b">
                                                    <li class="me-1 p-2 bg-grey d-inline-block rounded">
                                                        <input type="radio" name="flight_type" value="going_and_return" />
                                                        @lang('website.going_and_return')
                                                    </li>
                                                    <li class="me-1 p-2 bg-grey d-inline-block rounded">
                                                        <input type="radio" name="flight_type" value="going_only" /> @lang('website.going_only')
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <div class="input-box">
                                                            <label>@lang('website.takeoff_station')</label>
                                                            <select class="niceSelect" name="takeoff_station_id">
                                                                @foreach ($takeoffStations as $station)
                                                                    <option value="{{ $station->id }}">
                                                                        {{ $station->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <div class="input-box">
                                                            <label>@lang('website.arrival_station')</label>
                                                            <select class="niceSelect" name="arrival_station_id">
                                                                @foreach ($arrivalStations as $station)
                                                                    <option value="{{ $station->id }}">
                                                                        {{ $station->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <div class="input-box">
                                                            <label>@lang('website.travel_date')</label>
                                                            <input type="date" name="traveling_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <div class="input-box">
                                                            <label>@lang('website.return_date')</label>
                                                            <input type="date" name="return_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-0 text-center">
                                                    <button type="submit" class="nir-btn w-100"><i
                                                            class="fa fa-search me-2 mirror-ar"></i> @lang('website.search_flights')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('flight.index') }}" method="GET" id="my-form">
                                <div class="sidebar-item mb-4">
                                    <h5 class="">@lang('website.price_range')</h5>
                                    <div class="range-slider mt-0">
                                        <div data-min="0" data-max="100000" data-unit="$" data-min-name="min_price"
                                            data-max-name="max_price"
                                            class="range-slider-ui ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                            aria-disabled="false">
                                            <span class="min-value">0 EGP</span>
                                            <span class="max-value">100000 EGP</span>
                                            <div class="ui-slider-range ui-widget-header ui-corner-all full"
                                                style="left: 0%; width: 100%"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="sidebar-item mb-4">
                                    <h5 class="">@lang('website.travel_class')</h5>
                                    <ul class="sidebar-category1">
                                        <li>
                                            <input type="checkbox" name="categories[]" value="economic" /> @lang('website.economic')
                                            <span class="float-end">{{ $economicTypeCount }}</span>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="categories[]" value="business_men" /> @lang('website.business_men')
                                            <span class="float-end">{{ $businessMenTypeCount }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="sidebar-item mb-4" id="append">
                                    <h5 class="">@lang('website.airlines')</h5>
                                    <ul class="sidebar-category1">
                                        @foreach ($airLines as $airLine)
                                            <li>
                                                <input type="checkbox" name="air_lines_ids[]" /> {{ $airLine->name }}
                                                <span class="float-end">
                                                    {{ Modules\Package\Entities\Flight::where('air_lines_id', $airLine->id)->count() }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- top Destination ends -->

    <!-- Discount action starts -->
    <section class="discount-action pt-6"
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
                            <h5 class="mb-1 theme1">@lang('website.secrets_of_pilot_company')</h5>
                            <h2>
                                <a href="#">@lang('website.discover_yourself')!!
                                    <span class="theme1">
                                        @lang('website.travel_anywhere_around_the_world')</span></a>
                            </h2>
                            <p>
                                @lang('website.secrets_of_pilot_provide_services')
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
            // Event listener for checkboxes
            $('input[name="categories[]"], input[name="air_lines_ids[]"]').on('change', function() {
                filterFlights();
            });

            // Function to filter flights based on selected options
            function filterFlights() {
                // Get the selected categories
                var categories = [];
                $('input[name="categories[]"]:checked').each(function() {
                    categories.push($(this).val());
                });

                var priceRange = $('.range-slider-ui').slider('values');

                // Prepare the data to be sent via AJAX
                var data = {
                    categories: categories,
                    min_price: priceRange[0],
                    max_price: priceRange[1]
                };

                // Send AJAX request to update the flight list
                $.ajax({
                    url: "{{ route('flight.index') }}",
                    method: 'GET',
                    data: data,
                    success: function(response) {
                        // Get the new flight list JSON
                        $('.flight-full').html(response);
                    }
                });
            }

            $('.range-slider-ui').on('slidechange', function(event, ui) {
                var minPrice = ui.values[0];
                var maxPrice = ui.values[1];

                $('#my-form').append("<input type='hidden' name='min_price' value='" + minPrice + "'/>");
                $('#my-form').append("<input type='hidden' name='max_price' value='" + maxPrice + "'/>");

                filterFlights();
            });
        });
    </script>
@endpush
