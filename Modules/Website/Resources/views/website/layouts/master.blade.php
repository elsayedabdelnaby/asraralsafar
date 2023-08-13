<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        أسرار الطيار | حجز طيران تأشيرات و رحلات بحرية - رخص دولية - حجز الفنادق
    </title>
    <meta />
    <!-- Favicon -->
    <link rel="icon shortcut" type="image/png" href="{{ global_asset('website/images/icon.png') }}" sizes="32x32" />
    <link rel="icon shortcut" type="image/png" href="{{ global_asset('website/images/icon.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ global_asset('website/images/icon.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ global_asset('website/images/icon.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ global_asset('website/images/icon.png') }}" />
    <meta name="msapplication-TileImage" content="{{ global_asset('website/images/icon.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ global_asset('website/images/icon.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ global_asset('website/images/icon.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ global_asset('website/images/icon.png') }}" />
    <!-- Website Meta Tags -->
    <meta name="google-site-verification" content="" />
    <meta name="description" content="أسرار الطيار | حجز طيران تأشيرات و رحلات بحرية - رخص دولية - حجز الفنادق" />
    <meta name="keywords" content="أسرار الطيار , حجز فنادق , حجز طيران , تأشيرات , رخص دولية , رحلات بحرية" />
    <meta name="author" content="Ahmed Ali Mohamed" />
    <meta name="og:title" content="أسرار الطيار | حجز طيران تأشيرات و رحلات بحرية - رخص دولية - حجز الفنادق" />
    <meta name="og:description" content="أسرار الطيار | حجز طيران تأشيرات و رحلات بحرية - رخص دولية - حجز الفنادق" />
    @yield('meta_page')
    <meta name="og:image" content="{{ global_asset('website/images/og-icon.jpg') }}" />
    @if (app()->getLocale() == 'ar')
        <!-- Bootstrap core CSS -->
        <link href="{{ global_asset('website/css/bootstrap.rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <!--Plugin CSS-->
        <link href="{{ global_asset('website/css/plugin.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--Custom CSS-->
        <link href="{{ global_asset('website/css/style.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <!-- Bootstrap core CSS -->
        <link href="{{ global_asset('website/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!--Custom CSS-->
        <link href="{{ global_asset('website/css/style.css') }}" rel="stylesheet" type="text/css" />
        <!--Plugin CSS-->
        <link href="{{ global_asset('website/css/plugin.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ global_asset('website/fonts/line-icons.css') }}" type="text/css" />
    <script>
        {{ $websiteInfo->facebook_pixel_code }}
    </script>
    <script>
        {{ $websiteInfo->google_analytics_code }}
    </script>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status"></div>
    </div>
    <!-- Preloader Ends -->

    <!-- header starts -->
    @include('website::website.partials.header')
    <!-- header ends -->

    <!-- content starts -->
    @yield('content')
    <!-- content ends -->

    <!-- footer starts -->
    @include('website::website.partials.footer')
    <!-- footer ends -->

    <!-- Back to top start -->
    <div id="back-to-top">
        <a href="#"></a>
    </div>
    <!-- Back to top ends -->

    <!-- search popup -->
    {{-- <div id="search1">
      <button type="button" class="close">×</button>
      <form>
        <input type="search" value="" placeholder="Search Packages, Offers, ...." />
        <button type="submit" class="btn btn-primary mt-3">Search</button>
      </form>
    </div> --}}

    <!-- login registration modal -->
    {{-- <div class="modal fade log-reg" id="exampleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="post-tabs">
              <!-- tab navs -->
              <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button aria-controls="login" aria-selected="false" class="nav-link active" data-bs-target="#login"
                    data-bs-toggle="tab" id="login-tab" role="tab" type="button">
                    Login
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button aria-controls="register" aria-selected="true" class="nav-link" data-bs-target="#register"
                    data-bs-toggle="tab" id="register-tab" role="tab" type="button">
                    Register
                  </button>
                </li>
              </ul>
              <!-- tab contents -->
              <div class="tab-content blog-full" id="postsTabContent">
                <!-- popular posts -->
                <div aria-labelledby="login-tab" class="tab-pane fade active show" id="login" role="tabpanel">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="blog-image rounded">
                        <a href="#" style="
                            background-image: url(images/trending/trending5.jpg);
                          "></a>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4 class="text-center border-b pb-2">Login</h4>
                      <div class="log-reg-button d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-fb">
                          <i class="fab fa-facebook"></i> Login with Facebook
                        </button>
                        <button type="submit" class="btn btn-google">
                          <i class="fab fa-google"></i> Login with Google
                        </button>
                      </div>
                      <hr class="log-reg-hr position-relative my-4 overflow-visible" />
                      <form method="post" action="#" name="contactform" id="contactform">
                        <div class="form-group mb-2">
                          <input type="text" name="user_name" class="form-control" id="fname"
                            placeholder="User Name or Email Address" />
                        </div>
                        <div class="form-group mb-2">
                          <input type="password" name="password_name" class="form-control" id="lpass"
                            placeholder="Password" />
                        </div>
                        <div class="form-group mb-2">
                          <input type="checkbox" class="custom-control-input" id="exampleCheck" />
                          <label class="custom-control-label mb-0" for="exampleCheck1">Remember me</label>
                          <a class="float-end" href="#">Lost your password?</a>
                        </div>
                        <div class="comment-btn mb-2 pb-2 text-center border-b">
                          <input type="submit" class="nir-btn w-100" id="submit" value="Login" />
                        </div>
                        <p class="text-center">
                          Don't have an account?
                          <a href="#" class="theme">Register</a>
                        </p>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Recent posts -->
                <div aria-labelledby="register-tab" class="tab-pane fade" id="register" role="tabpanel">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="blog-image rounded">
                        <a href="#" style="
                            background-image: url(images/trending/trending5.jpg);
                          "></a>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4 class="text-center border-b pb-2">Register</h4>
                      <div class="log-reg-button d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-fb">
                          <i class="fab fa-facebook"></i> Login with Facebook
                        </button>
                        <button type="submit" class="btn btn-google">
                          <i class="fab fa-google"></i> Login with Google
                        </button>
                      </div>
                      <hr class="log-reg-hr position-relative my-4 overflow-visible" />
                      <form method="post" action="#" name="contactform1" id="contactform1">
                        <div class="form-group mb-2">
                          <input type="text" name="user_name" class="form-control" id="fname1"
                            placeholder="User Name" />
                        </div>
                        <div class="form-group mb-2">
                          <input type="text" name="user_name" class="form-control" id="femail"
                            placeholder="Email Address" />
                        </div>
                        <div class="form-group mb-2">
                          <input type="password" name="password_name" class="form-control" id="lpass1"
                            placeholder="Password" />
                        </div>
                        <div class="form-group mb-2">
                          <input type="password" name="password_name" class="form-control" id="lrepass"
                            placeholder="Re-enter Password" />
                        </div>
                        <div class="form-group mb-2 d-flex">
                          <input type="checkbox" class="custom-control-input" id="exampleCheck1" />
                          <label class="custom-control-label mb-0 ms-1 lh-1" for="exampleCheck1">I have read and accept
                            the Terms and Privacy
                            Policy?</label>
                        </div>
                        <div class="comment-btn mb-2 pb-2 text-center border-b">
                          <input type="submit" class="nir-btn w-100" id="submit1" value="Register" />
                        </div>
                        <p class="text-center">
                          Already have an account?
                          <a href="#" class="theme">Login</a>
                        </p>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    <!-- Whatsapp -->

    <a href="#" class="fixed-whatsapp">
        <img src="{{ global_asset('website/images/icons/whatsapp.svg') }}" alt="Whatsapp" />
    </a>

    <!-- *Scripts* -->
    <script src="{{ global_asset('website/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ global_asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ global_asset('website/js/plugin.js') }}"></script>
    <script src="{{ global_asset('website/js/main.js') }}"></script>
    <script src="{{ global_asset('website/js/custom-swiper.js') }}"></script>
    <script src="{{ global_asset('website/js/custom-nav.js') }}"></script>
    @stack('js')
</body>

</html>
