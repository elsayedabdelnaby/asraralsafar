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
    <!-- BreadCrumb -->
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
                    <h1 class="mb-3 fs-2">@lang('website.Contact Us')</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="#">@lang('website.Home')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('website.Contact Us')
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb -->

    <!-- contact -->
    <section class="contact-main pt-10 pb-10">
        <div class="container">
            <div class="contact-info-main mt-0">
                <div class="row">
                    <div class="col-lg-10 col-offset-lg-1 mx-auto">
                        <div class="contact-info bg-white">
                            <div class="contact-info-title text-center mb-4 px-5">
                                <h3 class="mb-1">@lang('website.Contact Data')</h3>
                                <p class="mb-0">
                                    @lang('website.Contact us through mobile number, WhatsApp, email, or visit our company through the address provided. You can also fill out the form below and send us a message.')
                                </p>
                            </div>
                            <div class="contact-info-content row mb-5 g-4">
                                <div class="col-lg-4 col-md-6">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded-3 h-100">
                                        <div class="info-icon mb-2">
                                            <img src="{{ global_asset('website') }}/images/icons/location-marker.svg"
                                                alt="Location" width="80" />
                                        </div>
                                        <div class="info-content">
                                            <h3>@lang('website.Visit Our Location')</h3>
                                            @foreach ($locationInfo as $info)
                                                <p class="m-0">
                                                    {{ $info }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded-3 h-100">
                                        <div class="info-icon mb-2">
                                            <img src="{{ global_asset('website') }}/images/icons/phone-color.svg"
                                                alt="Phone" width="80" />
                                        </div>
                                        <div class="info-content">
                                            <h3>@lang('website.Phone Number')</h3>
                                            @foreach ($phoneInfo as $info)
                                                <p class="m-0">
                                                    {{ $info }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded-3 h-100">
                                        <div class="info-icon mb-2">
                                            <img src="{{ global_asset('website') }}/images/icons/email.svg" alt="Email"
                                                width="80" />
                                        </div>
                                        <div class="info-content ps-4">
                                            <h3>@lang('website.Email')</h3>
                                            @foreach ($emailInfo as $info)
                                                <p class="m-0 fs-18">
                                                    {{ $info }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contact-form" class="contact-form">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="map rounded overflow-hiddenb rounded mb-md-4">
                                            <div style="width: 100%">
                                                <iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7257892.319301943!2d33.7447929!3d27.3478218!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f01c79476e3b3%3A0x10ab6309deba58a5!2z2KPYs9ix2KfYsSDYp9mE2LfZitin2LEg2YTZhNiz2YHYsSDZiNin2YTYs9mK2KfYrdip!5e0!3m2!1sen!2seg!4v1695126227749!5m2!1sen!2seg"
                                                    height="450" style="border: 0" allowfullscreen="" loading="lazy"
                                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if ($errors->any())
                                            <div id="contactform-error-msg">{{ $errors->first() }}</div>
                                        @endif

                                        @if (session()->has('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <form method="post" action="{{ route('website.contact-us.store') }}">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <input type="text" name="first_name" class="form-control"
                                                    placeholder="@lang('website.First Name')" />
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="text" name="last_name" class="form-control"
                                                    placeholder="@lang('website.Last Name')" />
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="@lang('website.Email')" />
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="@lang('website.Mobile Number or WhatsApp')" />
                                            </div>
                                            <div class="textarea mb-2">
                                                <textarea name="message" placeholder="@lang('website.Your Message')"></textarea>
                                            </div>
                                            <div class="comment-btn text-center">
                                                <input type="submit" class="nir-btn w-100" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact -->
@endsection
