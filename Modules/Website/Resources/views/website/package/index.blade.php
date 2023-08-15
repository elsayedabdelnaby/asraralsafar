@extends('website::website.layouts.master')
@section('content')
    <!-- BreadCrumb Starts -->
    <section class="breadcrumb-main pb-8 pt-8 no-radius"
        style="
  background-image: url({{ global_asset('website') }}/images/tourism1.webp);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: top;
">
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1 class="mb-3 fs-2">@lang('website.tourism trips')</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">@lang('website.home page')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('website.Offers')
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
    <section class="trending pt-10 pb-0 bg-lgrey mb-10 px-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 pe-lg-5">
                    <div class="sidebar-sticky">
                        <div class="list-sidebar">
                            <div id="form-container">
                                <form action="{{ route('package.index') }}" method="GET" id="my-form">
                                    <div class="sidebar-item mb-4">
                                        <h4>@lang('website.destination')</h4>
                                        <ul class="sidebar-category1">
                                            @foreach ($countryCounts as $countryId => $count)
                                                <li>
                                                    <input type="checkbox" name="country_ids[]"
                                                        value="{{ $countryId }}" />
                                                    {{ Modules\Locations\Entities\Country::find($countryId)->load('translations')->display_name }}
                                                    <span class="float-end">{{ $count }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="sidebar-item mb-4">
                                        <h4 class="">@lang('website.trip time')</h4>
                                        <ul class="sidebar-category1">
                                            <li>
                                                <input type="checkbox" name="period[]" value="1-3 days" /> من 1 - 3 أيام
                                                <span
                                                    class="float-end">{{ $packages->where('period', '1-3 days')->count() }}</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="period[]" value="3-5 days" /> من 3 - 5 أيام
                                                <span
                                                    class="float-end">{{ $packages->where('period', '3-5 days')->count() }}</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="period[]" value="5-7 days" /> من 5 - 7 أيام
                                                <span
                                                    class="float-end">{{ $packages->where('period', '5-7 days')->count() }}</span>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="period[]" value="7-10 days" /> من 7 ألى 10 أيام
                                                <span
                                                    class="float-end">{{ $packages->where('period', '7-10 days')->count() }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="sidebar-item mb-4">
                                        <h4 class="">@lang('website.trip price')</h4>
                                        <div class="range-slider mt-0">
                                            <p class="text-start mb-2">@lang('website.price scope')</p>
                                            <div data-min="0" data-max="2000" data-unit="$" data-min-name="min_price"
                                                data-max-name="max_price"
                                                class="range-slider-ui ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                                aria-disabled="false">
                                                <span class="min-value">500 حنيه</span>
                                                <span class="max-value">10000 جنيه</span>
                                                <div class="ui-slider-range ui-widget-header ui-corner-all full"
                                                    style="left: 0%; width: 100%"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="destination-list">
                        <div class="row g-4">
                            @foreach ($packages->chunk(2) as $chunk)
                                <div class="col-xl-6">
                                    @foreach ($chunk as $package)
                                        <div class="trend-item rounded box-shadow">
                                            <!-- Package content goes here -->
                                            <!-- Replace this with your package HTML structure -->
                                            <div class="trend-image position-relative">
                                                <img src="{{ global_asset("storage/website/$package->image") }}"
                                                    alt="image" class="package" />
                                                <div class="color-overlay"></div>
                                            </div>
                                            <div class="trend-content p-4 pt-5 position-relative">
                                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                                    <div class="entry-author fs-14">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        <span class="fw-bold">{{ $package->number_of_days }}</span>
                                                    </div>
                                                </div>
                                                <h5 class="theme mb-1">
                                                    <i class="flaticon-location-pin"></i>
                                                    {{ $package->country->load('translations')->display_name }}
                                                </h5>
                                                <h3 class="mb-1">
                                                    <a
                                                        href="{{ route('package.show', $package->id) }}">{{ $package->title }}</a>
                                                </h3>
                                                <div class="rating-main d-flex align-items-center pb-2">
                                                    <p class="border-b pb-2 mb-2">{{ $package->description }}</p>
                                                    <div class="entry-meta">
                                                        <div class="entry-author d-flex align-items-center">
                                                            <p class="mb-0">
                                                                <span
                                                                    class="theme fw-bold fs-5">${{ $package->price }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <br><br>
                                    @endforeach
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
                                @for ($i = 1; $i <= $packages->lastPage(); $i++)
                                    <li class="{{ $packages->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $packages->url($i) }}" class="page-link">{{ $i }}</a>
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
            // Function to update the packages list
            function updatePackagesList(packages) {
                var destinationList = $('.destination-list');
                var packagesHTML = '';

                $.each(packages.data, function(index, package) {
                    if (index % 2 === 0) {
                        // Start a new row
                        packagesHTML += '<div class="row g-4">';
                    }

                    console.log(package);

                    // Build the HTML for each package item
                    var packageItem = `
        <div class="col-xl-6">
          <div class="trend-item rounded box-shadow">
            <div class="trend-image position-relative">
              <img src="{{ global_asset("storage/website/$package->image") }}" alt="image" class="package" />
              <div class="color-overlay"></div>
            </div>
            <div class="trend-content p-4 pt-5 position-relative">
              <div class="trend-meta bg-theme white px-3 py-2 rounded">
                <div class="entry-author fs-14">
                  <i class="far fa-calendar-alt me-1"></i>
                  <span class="fw-bold">${package.number_of_days}</span>
                </div>
              </div>
              <h5 class="theme mb-1">
                <i class="flaticon-location-pin"></i>
                ${package.country.display_name}
              </h5>
              <h3 class="mb-1">
                <a href="${package.url}">${package.title}</a>
              </h3>
              <div class="rating-main d-flex align-items-center pb-2">
                <p class="border-b pb-2 mb-2">${package.description}</p>
                <div class="entry-meta">
                  <div class="entry-author d-flex align-items-center">
                    <p class="mb-0">
                      <span class="theme fw-bold fs-5">$${package.price}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;

                    packagesHTML += packageItem;

                    if (index % 2 === 1 || index === packages.data.length - 1) {
                        // End the row
                        packagesHTML += '</div><br><br>';
                    }
                });

                destinationList.html(packagesHTML);
            }

            // Function to update the pagination links
            function updatePaginationLinks(packages) {
                var paginationContainer = $('.theme-pagination ul');
                var paginationHTML = '';

                for (var i = 1; i <= packages.last_page; i++) {
                    var activeClass = (i === packages.current_page) ? 'active' : '';
                    var pageLink = `
        <li class="${activeClass}">
          <a href="${packages.path}?page=${i}" class="page-link">${i}</a>
        </li>
      `;

                    paginationHTML += pageLink;
                }

                paginationContainer.html(paginationHTML);
            }

            // Function to handle the AJAX request
            function submitForm() {
                $.ajax({
                    url: $('#my-form').attr('action'),
                    method: 'GET',
                    data: $('#my-form').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Update the packages list and pagination links with the new data
                        updatePackagesList(response.packages);
                        updatePaginationLinks(response.packages);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Function to handle the AJAX request
            function submitForm() {
                $.ajax({
                    url: $('#my-form').attr('action'),
                    method: 'GET',
                    data: $('#my-form').serialize(),
                    dataType: 'json', // Add this line
                    success: function(response) {
                        // Update the packages list and pagination links with the new data
                        updatePackagesList(response.packages);
                        updatePaginationLinks(response.packages);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Event handler for form input change
            $('#my-form input').on('change', function() {
                submitForm();
            });

            // Event handler for range slider change
            $('.range-slider-ui').on('slidechange', function(event, ui) {
                var minPrice = ui.values[0];
                var maxPrice = ui.values[1];

                // Update the min-value and max-value elements
                $('.min-value').text(minPrice + ' حنيه');
                $('.max-value').text(maxPrice + ' جنيه');

                $('#my-form').append("<input type='hidden' name='min_price' value='" + minPrice + "'/>");
                $('#my-form').append("<input type='hidden' name='max_price' value='" + maxPrice + "'/>");


                submitForm();
            });
        });
    </script>
@endpush
