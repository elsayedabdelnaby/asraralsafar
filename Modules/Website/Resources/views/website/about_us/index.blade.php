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
                    <h1 class="mb-3 fs-2">@lang('website.about company')</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">@lang('website.home page')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('website.about company')
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->
    @foreach ($sections as $section)
        {!! $section->description !!}
    @endforeach

    <!-- testomonial start -->
    <section class="testimonial pt-9" style="background-image: url(images/testimonial.png)">
        <div class="container">
            <div class="section-title mb-6 text-center w-75 mx-auto">
                <h4 class="mb-1 theme1">@lang('website.what clients say about us?')</h4>
                <h2 class="mb-1">@lang('website.discover opinions') <span class="theme">@lang('website.clients') </span></h2>
                <p>@lang('website.discover clients opinions and how much they are satisfied')</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 pe-4">
                    <div class="testimonial-image">
                        <img src="{{ global_asset('website') }}/images/travel2.png" alt="" />
                    </div>
                </div>
                <div class="col-lg-7 ps-4">
                    <div class="row review-slider">
                        @foreach ($testimonails as $testimonail)
                            <div class="col-sm-4 item">
                                <div class="testimonial-item1 rounded">
                                    <div class="author-info d-flex align-items-center mb-4">
                                        <img src="{{ global_asset('website/') }}/images/og-icon.jpg" alt="" />
                                        <div class="author-title ms-3">
                                            <h5 class="m-0 theme">{{ $testimonail->client_name }}</h5>
                                            <span>{{ __('website::website.client') }}</span>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <p class="m-0">
                                            <i class="fa fa-quote-left me-2 fs-1"></i>{{ $testimonail->testimonail }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
