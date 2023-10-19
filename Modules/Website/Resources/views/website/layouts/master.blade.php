<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}"
    dir="@if (app()->getLocale() == 'ar') rtl @else ltr @endif">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        أسرار الطيار | حجز طيران تأشيرات و رحلات بحرية - رخص دولية - حجز الفنادق
    </title>
    <meta />
    <!-- Favicon -->
    <link rel="icon shortcut" type="image/png" href="{{ global_asset('website/images/fav-icons/favicon-32x32.png') }}"
        sizes="32x32" />
    <link rel="icon shortcut" type="image/png"
        href="{{ global_asset('website/images/fav-icons/android-icon-192x192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" sizes="57x57"
        href="{{ global_asset('website/images/fav-icons/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ global_asset('website/images/fav-icons/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ global_asset('website/images/fav-icons/apple-icon-152x152.png') }}" />
    <meta name="msapplication-TileImage" content="{{ global_asset('website/images/fav-icons/favicon-96x96.png') }}" />
    <meta name="msapplication-square70x70logo"
        content="{{ global_asset('website/images/fav-icons/ms-icon-70x70.png') }}" />
    <meta name="msapplication-square150x150logo"
        content="{{ global_asset('website/images/fav-icons/ms-icon-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo"
        content="{{ global_asset('website/images/fav-icons/ms-icon-310x310.png') }}" />
    <link rel="icon" type="image/x-icon" href="{{ global_asset('website/images/fav-icons/favicon.ico') }}">
    <!-- Website Meta Tags -->
    @yield('meta_page')
    <meta name="og:image" content="{{ global_asset('website/images/fav-icons/android-icon-192x192.png') }}" />
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

    <!-- Whatsapp -->

    <a href="https://wa.me/{{ $whatsApp->value }}" class="fixed-whatsapp" target="_blank">
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
