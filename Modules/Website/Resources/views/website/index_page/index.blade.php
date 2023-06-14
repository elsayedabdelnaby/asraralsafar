@extends('website::website.layouts.master')

@section('content')
<div class="tet"></div>

<!-- banner starts -->
<section class="banner pt-10 pb-0 overflow-hidden" style="
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
            <h4 class="theme mb-0">Explore The World</h4>
            <h1>Start Planning Your Dream Trip Today!</h1>
            <p class="mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
              do eiusmod tempor incididunt ut labore
            </p>
            <div class="book-form">
              <div class="row d-flex align-items-center justify-content-between">
                <div class="col-lg-6 mb-2">
                  <div class="form-group">
                    <div class="input-box">
                      <select class="niceSelect">
                        <option value="1">Destination</option>
                        <option value="2">Argentina</option>
                        <option value="3">Belgium</option>
                        <option value="4">Canada</option>
                        <option value="5">Denmark</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-2">
                  <div class="form-group">
                    <div class="input-box">
                      <input class="form-control" type="datetime-local" name="date" placeholder="Select Date" />
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-2">
                  <div class="form-group">
                    <div class="input-box">
                      <select class="niceSelect">
                        <option value="1">Travel Type</option>
                        <option value="2">City Tour</option>
                        <option value="3">Family Tour</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-2">
                  <div class="form-group">
                    <div class="input-box">
                      <select class="niceSelect">
                        <option value="1">Tour Duration</option>
                        <option value="2">5 days</option>
                        <option value="3">7 Days</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group mb-0 text-center">
                    <a href="./packages.rtl.html" class="nir-btn w-100"><i class="fa fa-search me-2"></i> Search
                      Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="banner-image">
            <img src="{{ asset('website') }}/images/travel.png" alt="travel" />
          </div>
        </div>
      </div>
      <div class="category-main-inner border-t pt-1 mb-4">
        <div class="row g-4">
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="category-item box-shadow p-3 py-4 text-center bg-white rounded overflow-hidden h-100">
              <div class="trending-topic-content">
                <img width="20" src="{{ asset('website') }}/images/hotel.svg" class="mb-1 d-inline-block" alt="Book Hotel" />
                <h4 class="mb-0 fs-18">
                  <a href="#">Hotels</a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="category-item box-shadow p-3 py-4 text-center bg-white rounded overflow-hidden h-100">
              <div class="trending-topic-content text-center">
                <img src="{{ asset('website') }}/images/plane.svg" class="mb-1 d-inline-block" alt="Flight" />
                <h4 class="mb-0 fs-18">
                  <a href="#">Flights</a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="category-item box-shadow p-3 py-4 text-center bg-white rounded overflow-hidden h-100">
              <div class="trending-topic-content">
                <img src="{{ asset('website') }}/images/cruise.svg" class="mb-1 d-inline-block" alt="Cruise" />
                <h4 class="mb-0 fs-18">
                  <a href="#">Cruise</a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="category-item box-shadow p-3 py-4 text-center bg-white rounded overflow-hidden h-100">
              <div class="trending-topic-content">
                <img src="{{ asset('website') }}/images/boarding-pass.svg" class="mb-1 d-inline-block" alt="Visa" />
                <h4 class="mb-0 fs-18"><a href="./index.html">Visa</a></h4>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-4 col-md-6">
            <div class="category-item box-shadow p-3 py-4 text-center bg-white rounded overflow-hidden h-100">
              <div class="trending-topic-content">
                <img src="{{ asset('website') }}/images/icons/drivers-license.svg" class="mb-1 d-inline-block" alt="license" />
                <h4 class="mb-0 fs-18">
                  <a href="#">International License</a>
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- about-us starts -->
    <section class="about-us pb-6 pt-6"
        style="
    background-image: url(images/shape4.png);
    background-position: center;
  ">
        <div class="container">
            <div class="section-title mb-6 w-50 mx-auto text-center">
                <h4 class="mb-1 theme1">Asrar AlTayar</h4>
                <h2 class="mb-1">
                    <span class="theme">Your Optimal Choice</span>
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
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
                                        <img src="{{ asset('website/') }}/images/icons/easy.svg" alt="Easy"
                                            width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">Flexible And Easy</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        You can make your reservation easily through our website.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ asset('website/') }}/images/icons/trust.svg" alt="Trusted"
                                            width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">Trusted And Credibile</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        Asrar Altayar is Trusted by all its clients, Explore
                                        Testimonails.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ asset('website/') }}/images/icons/customer-review.svg"
                                            alt="Review" width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">Client Focus</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        Asrar Altayar focuses mainly on client's satisfaction and
                                        happiness.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="why-us-item text-center p-4 py-5 border rounded bg-white h-100">
                                <div class="why-us-content">
                                    <div class="why-us-icon mb-3">
                                        <img src="{{ asset('website/') }}/images/icons/customer-service.svg"
                                            alt="customer service" width="70" />
                                    </div>
                                    <h4>
                                        <a href="#">24 Hours Support</a>
                                    </h4>
                                    <p class="mb-0 fs-14">
                                        Asrar Altayar is supporting clients 24 hrs/day & 7
                                        days/week.
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
                <h4 class="mb-1 theme1">Trending Destinations</h4>
                <h2 class="mb-1">
                    Explore <span class="theme">Top Destinations</span>
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="trend-item1">
                        <div class="trend-image position-relative rounded">
                            <img class="lg" src="{{ asset('website/') }}/images/destination/d1.jpg"
                                alt="destination" />
                            <div
                                class="trend-content d-flex flex-md-row flex-column align-items-md-center justify-content-md-between align-items-start position-absolute bottom-0 p-4 w-100 z-index">
                                <div class="trend-content-title">
                                    <h4 class="mb-0">
                                        <a href="{{ asset('website/') }}/packages.rtl.html" class="text-white">Italy</a>
                                    </h4>
                                    <h3 class="mb-0 white">Caspian Valley</h3>
                                </div>
                                <span class="white bg-theme1 fs-12 p-1 px-2 rounded mt-md-0 mt-3 text-center">18
                                    Packages</span>
                            </div>
                            <div class="color-overlay"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="trend-item1">
                        <div class="trend-image position-relative rounded">
                            <img class="lg" src="{{ asset('website/') }}/images/destination/d2.jpg"
                                alt="destination" />
                            <div
                                class="trend-content d-flex flex-md-row flex-column align-items-md-center justify-content-md-between align-items-start position-absolute bottom-0 p-4 w-100 z-index">
                                <div class="trend-content-title">
                                    <h4 class="mb-0">
                                        <a href="{{ asset('website/') }}/packages.rtl.html" class="text-white">Sweden</a>
                                    </h4>
                                    <h3 class="mb-0 white">Plant Valley</h3>
                                </div>
                                <span class="white bg-theme1 fs-12 p-1 px-2 rounded mt-md-0 mt-3 text-center">14
                                    Packages</span>
                            </div>
                            <div class="color-overlay"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="trend-item1">
                        <div class="trend-image position-relative rounded">
                            <img class="lg" src="{{ asset('website/') }}/images/trending/p1.jpg"
                                alt="destination" />
                            <div
                                class="trend-content d-flex flex-md-row flex-column align-items-md-center justify-content-md-between align-items-start position-absolute bottom-0 p-4 w-100 z-index">
                                <div class="trend-content-title">
                                    <h4 class="mb-0">
                                        <a href="{{ asset('website/') }}/packages.rtl.html" class="text-white">Egypt</a>
                                    </h4>
                                    <h3 class="mb-0 white">The Pyramids</h3>
                                </div>
                                <span class="white bg-theme1 fs-12 p-1 px-2 rounded mt-md-0 mt-3 text-center">10
                                    Packages</span>
                            </div>
                            <div class="color-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="action text-center mt-5">
                <a class="nir-btn" href="{{ asset('website/') }}/packages.rtl.html">
                    <i class="fa fa-plane me-1"></i>
                    View All Destinations
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
                            <img src="{{ asset('website/') }}/images/travel1.png" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 ps-4">
                        <div class="about-content text-center text-lg-start mb-4 pb-100">
                            <h4 class="theme d-inline-block mb-0">Get To Know Us</h4>
                            <h2 class="border-b mb-2 pb-1">
                                Explore All Tour of the world with us.
                            </h2>
                            <p class="border-b mb-2 pb-2">
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
                                        <i class="fa fa-binoculars theme me-1"></i> Excellent
                                        Packages
                                    </li>
                                    <li class="fs-14">
                                        <i class="fa fa-dollar-sign me-1"></i> Competitive Prices
                                    </li>
                                    <li class="fs-14">
                                        <i class="fa fa-shield-alt me-1"></i> Trust & Credibility
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
                                                <h2 class="value mb-0 theme">{{ $statistic->translations->first()->number }}</h2>
                                                <span class="m-0">{{ $statistic->translations->first()->title }}</span>
                                            </div>
                                        </div>
                                    </div>  
                                    @endforeach
                                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                        <div class="counter-item border-end pe-4">
                                            <div class="counter-content text-sm-start text-center">
                                                <h2 class="value mb-0 theme">20</h2>
                                                <span class="m-0">Years Experiences</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                        <div class="counter-item border-end pe-4">
                                            <div class="counter-content text-sm-start text-center">
                                                <h2 class="value mb-0 theme">530</h2>
                                                <span class="m-0">Tour Packages</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                        <div class="counter-item border-end pe-4">
                                            <div class="counter-content text-sm-start text-center">
                                                <h2 class="value mb-0 theme">850</h2>
                                                <span class="m-0">Happy Customers</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                        <div class="counter-item">
                                            <div class="counter-content text-sm-start text-center">
                                                <h2 class="value mb-0 theme">320</h2>
                                                <span class="m-0">Award Winning</span>
                                            </div>
                                        </div>
                                    </div>
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

    <!-- best tour Starts -->
    <section class="trending pb-0">
        <div class="container">
            <div class="row align-items-center justify-content-between mb-6">
                <div class="col-lg-7">
                    <div class="section-title text-center text-lg-start">
                        <h4 class="mb-1 theme1">Top Packages</h4>
                        <h2 class="mb-1">
                            Best <span class="theme">Tour Packages</span>
                        </h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>
            <div class="trend-box overflow-hidden">
                <div class="row item-slider">
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/trending/p1.jpg" alt="image"
                                    class="package" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Egypt
                                </h5>
                                <h3 class="mb-1">
                                    <a href="{{ asset('website/') }}/package.rtl.html">Sharm Elsheikh Resort</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(12)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $190.00</span> /
                                            <s>$350.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/trending/p3.jpg" alt="image"
                                    class="package" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Egypt
                                </h5>
                                <h3 class="mb-1">
                                    <a href="{{ asset('website/') }}/package.rtl.html">Piazza Castello</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(12)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $270.00</span> /
                                            <s>$400.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/destination/d1.jpg" alt="image"
                                    class="package" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Spain
                                </h5>
                                <h3 class="mb-1">
                                    <a href="{{ asset('website/') }}/package.rtl.html">Maldives Beach</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(12)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $170.00</span> /
                                            <s>$300.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/trending/p1.jpg" alt="image"
                                    class="package" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Egypt
                                </h5>
                                <h3 class="mb-1">
                                    <a href="{{ asset('website/') }}/package.rtl.html">Piazza Castello</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(12)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $170.00</span> /
                                            <s>$300.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action text-center mt-5">
                    <a class="nir-btn" href="{{ asset('website/') }}/packages.rtl.html">
                        <i class="fa fa-plane me-1"></i>
                        View All Packages
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- best tour Ends -->

    <!-- Last Minute Deal Starts -->
    <section class="trending pb-0 pt-6" style="background-image: url(images/shape2.png)">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">Top Deals</h4>
                <h2 class="mb-1">The Last <span class="theme">Minute Deals</span></h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="trend-box">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/destination/d2.jpg" alt="image"
                                    class="destination" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative bg-white">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 4 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Spain
                                </h5>
                                <h3 class="mb-1">
                                    <a href="#">Barcelona city beach</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(21)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $220.00</span> /
                                            <s>$290.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/destination/d1.jpg" alt="image"
                                    class="destination" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative bg-white">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 4 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Spain
                                </h5>
                                <h3 class="mb-1">
                                    <a href="#">Barcelona city beach</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(21)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $220.00</span> /
                                            <s>$220.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="trend-item rounded box-shadow">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/destination/d3.jpg" alt="image"
                                    class="destination" />
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative bg-white">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 4 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Spain
                                </h5>
                                <h3 class="mb-1">
                                    <a href="#">Barcelona city beach</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(21)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $220.00</span> /
                                            <s>$340.00</s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action text-center mt-4 mb-8">
                    <a class="nir-btn" href="#">
                        <i class="fa fa-plane me-1"></i>
                        View All Offers
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Last Minute Deal Ends -->

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
                            <h5 class="mb-1 theme">Love Where Your're Going</h5>
                            <h2>
                                <a href="detail-fullwidth.html">Explore Your Life,
                                    <span class="theme1"> Travel Where You Want!</span></a>
                            </h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                        <div class="video-button text-center position-relative">
                            <div class="text-center">
                                <a href="{{ asset('website/') }}/packages.rtl.html" type="button"
                                    class="play-btn nir-btn">
                                    <i class="fa fa-plane me-1"></i>
                                    <span>Explore Offers</span>
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

    <!-- offer Packages Starts -->
    <section class="trending pb-0 pt-4">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">Top Offers</h4>
                <h2 class="mb-1">
                    Special <span class="theme">Offers & Discount </span> Packages
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="trend-box">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item rounded box-shadow bg-white">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/trending/p1.jpg" alt="image"
                                    class="" />
                                <div class="ribbon ribbon-top-left">
                                    <span class="fw-bold">20% OFF</span>
                                </div>
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Egypt
                                </h5>
                                <h3 class="mb-1">
                                    <a href="#">The Pyramids</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(12)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $170.00</span> /
                                            <s> $280.00 </s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="trend-item box-shadow rounded bg-white">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/trending/p2.jpg" alt="image" />
                                <div class="ribbon ribbon-top-left">
                                    <span class="fw-bold">30% OFF</span>
                                </div>
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Greece
                                </h5>
                                <h3 class="mb-1">
                                    <a href="tour-grid.html">Santorini, Oia</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(38)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $180.00</span> /
                                            <s> $320.00 </s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="trend-item box-shadow rounded bg-white">
                            <div class="trend-image position-relative">
                                <img src="{{ asset('website/') }}/images/trending/p3.jpg" alt="image" />
                                <div class="ribbon ribbon-top-left">
                                    <span class="fw-bold">15% OFF</span>
                                </div>
                                <div class="color-overlay"></div>
                            </div>
                            <div class="trend-content p-4 pt-5 position-relative">
                                <div class="trend-meta bg-theme white px-3 py-2 rounded">
                                    <div class="entry-author fs-14">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span class="fw-bold"> 9 Days</span>
                                    </div>
                                </div>
                                <h5 class="theme mb-1">
                                    <i class="flaticon-location-pin"></i> Maldives
                                </h5>
                                <h3 class="mb-1">
                                    <a href="tour-grid.html">Hurawalhi Island</a>
                                </h3>
                                <div class="rating-main d-flex align-items-center pb-2">
                                    <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="ms-2">(18)</span>
                                </div>
                                <p class="border-b pb-2 mb-2">
                                    Duis aute irure dolor in reprehenderit in voluptate velit
                                    esse cillum
                                </p>
                                <div class="entry-meta">
                                    <div class="entry-author d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="theme fw-bold fs-5"> $260.00</span> /
                                            <s> $400.00 </s>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- offer Packages Ends -->

    <!-- testomonial start -->
    <section class="testimonial pt-9" style="background-image: url(images/testimonial.png)">
        <div class="container">
            <div class="section-title mb-6 text-center w-75 mx-auto">
                <h4 class="mb-1 theme1">Our Testimonails</h4>
                <h2 class="mb-1">
                    Good Reviews By <span class="theme">Clients</span>
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 pe-4">
                    <div class="testimonial-image">
                        <img src="{{ asset('website/') }}/images/travel2.png" alt="" />
                    </div>
                </div>
                <div class="col-lg-7 ps-4">
                    <div class="row review-slider">
                        <div class="col-sm-4 item">
                            <div class="testimonial-item1 rounded">
                                <div class="author-info d-flex align-items-center mb-4">
                                    <img src="{{ asset('website/') }}/images/og-icon.jpg" alt="" />
                                    <div class="author-title ms-3">
                                        <h5 class="m-0 theme">Ahmed Ali Mohamed</h5>
                                        <span>Client</span>
                                    </div>
                                </div>
                                <div class="details">
                                    <p class="m-0">
                                        <i class="fa fa-quote-left me-2 fs-1"></i>Lorem Ipsum is
                                        simply dummy text of the printing andypesetting industry.
                                        Lorem ipsum a simple Lorem Ipsum has been the industry's
                                        standard dummy hic et quidem. Dignissimos maxime velit
                                        unde inventore quasi vero dolorem.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 item">
                            <div class="testimonial-item1 rounded">
                                <div class="author-info d-flex align-items-center mb-4">
                                    <img src="{{ asset('website/') }}/images/og-icon.jpg" alt="" />
                                    <div class="author-title ms-3">
                                        <h5 class="m-0 theme">Ahmed Ali Mohamed</h5>
                                        <span>Client</span>
                                    </div>
                                </div>
                                <div class="details">
                                    <p class="m-0">
                                        <i class="fa fa-quote-left me-2 fs-1"></i>Lorem Ipsum is
                                        simply dummy text of the printing andypesetting industry.
                                        Lorem ipsum a simple Lorem Ipsum has been the industry's
                                        standard dummy hic et quidem. Dignissimos maxime velit
                                        unde inventore quasi vero dolorem.
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
    <div class="our-partner p-0">
        <div class="container">
            <div class="partners_inner">
                <ul>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 1" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 2" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 3" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 4" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 5" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 6" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 7" /></li>
                    <li class="mb-2"><img src="{{ asset('website/') }}/images/logo.jpg" alt="Partner 8" /></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- partner ends -->

    <!-- recent-articles starts -->
    <section class="trending recent-articles pb-6">
        <div class="container">
            <div class="section-title mb-6 w-75 mx-auto text-center">
                <h4 class="mb-1 theme1">Our Blogs Offers</h4>
                <h2 class="mb-1">
                    Recent <span class="theme">Articles & Posts</span>
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore.
                </p>
            </div>
            <div class="recent-articles-inner">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="trend-item box-shadow bg-white mb-4 rounded overflow-hidden">
                            <div class="trend-image">
                                <img src="{{ asset('website/') }}/images/blog/b1.jpg" alt="image" />
                            </div>
                            <div class="trend-content-main p-4 pb-2">
                                <div class="trend-content">
                                    <h5 class="mb-1 fs-14">Flights</h5>
                                    <h4>
                                        <a href="{{ asset('website/') }}/blogs.details.rtl.html" class="text-dark">How a
                                            developer duo at Deutsche Bank keep
                                            remote
                                            alive.</a>
                                    </h4>
                                    <p class="mb-3">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                        sed do eiusmod
                                    </p>
                                    <div class="entry-meta d-flex align-items-center justify-content-between">
                                        <div class="entry-author mb-2">
                                            <img src="{{ asset('website/') }}/images/og-icon.jpg" alt=""
                                                class="rounded-circle me-1" />
                                            <span>Asrar Altayar</span>
                                        </div>
                                        <div class="entry-button d-flex align-items-centermb-2">
                                            <a href="{{ asset('website/') }}/blogs.details.rtl.html" class="nir-btn">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="trend-item box-shadow bg-white mb-4 rounded overflow-hidden">
                            <div class="trend-image">
                                <img src="{{ asset('website/') }}/images/blog/b2.jpg" alt="image" />
                            </div>
                            <div class="trend-content-main p-4 pb-2">
                                <div class="trend-content">
                                    <h5 class="fs-14 mb-1">Inspiration</h5>
                                    <h4>
                                        <a href="{{ asset('website/') }}/blogs.details.rtl.html"
                                            class="text-dark">Inspire Runner with Autism Graces of Women's
                                            Running</a>
                                    </h4>
                                    <p class="mb-3">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                        sed do eiusmod
                                    </p>
                                    <div class="entry-meta d-flex align-items-center justify-content-between">
                                        <div class="entry-author mb-2">
                                            <img src="{{ asset('website/') }}/images/og-icon.jpg" alt=""
                                                class="rounded-circle me-1" />
                                            <span>Asrar Altayar</span>
                                        </div>
                                        <div class="entry-button d-flex align-items-center mb-2">
                                            <a href="{{ asset('website/') }}/blogs.details.rtl.html" class="nir-btn">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="trend-item box-shadow bg-white mb-4 rounded overflow-hidden">
                            <div class="trend-image">
                                <img src="{{ asset('website/') }}/images/blog/b3.jpg" alt="image" />
                            </div>
                            <div class="trend-content-main p-4 pb-2">
                                <div class="trend-content">
                                    <h5 class="fs-14 mb-1">Public</h5>
                                    <h4>
                                        <a href="{{ asset('website/') }}/blogs.details.rtl.html"
                                            class="text-dark">Services To Grow Your Business Sell Affiliate
                                            Products</a>
                                    </h4>
                                    <p class="mb-3">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                        sed do eiusmod
                                    </p>
                                    <div class="entry-meta d-flex align-items-center justify-content-between">
                                        <div class="entry-author mb-2">
                                            <img src="{{ asset('website/') }}/images/og-icon.jpg" alt="user"
                                                class="rounded-circle me-1" />
                                            <span>Asrar Altayar</span>
                                        </div>
                                        <div class="entry-button d-flex align-items-center mb-2">
                                            <a href="{{ asset('website/') }}/blogs.details.rtl.html" class="nir-btn">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- recent-articles ends -->
@endsection
