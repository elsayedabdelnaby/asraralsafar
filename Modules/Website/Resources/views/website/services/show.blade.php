@extends('website::website.layouts.master')

@section('meta_page')
    <meta property="og:title" content="{{ $service->meta_title }}">
    <meta property="og:description" content="{{ $service->meta_description }}">
    <meta name="description" content="{{ $service->meta_description }}">
    <meta property="og:image" content="{{ $service->image_url }}">
    <style>
        .parsley-errors-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .parsley-errors-list li {
            color: #F64E60;
        }
    </style>
@endsection

@section('content')
    <!-- BreadCrumb Starts -->
    <section class="breadcrumb-main no-radius pb-8 pt-8"
        style="
        background-image: url({{ global_asset('website') }}/images/tourism1.webp);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
        @if (app()->getLocale() == 'ar') direction: rtl; @endif
      ">
        <div class="breadcrumb-outer">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h1 class="mb-3 fs-2">{{ $service->name }}</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="{{ url('/') }}">@lang('website.home page')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @lang('website.fill_in_the_information_to_register_the_reservation')
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb Ends -->

    <section class="trending pt-8 pb-5 bg-lgrey" @if (app()->getLocale() == 'ar') style="direction: rtl;" @endif>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12 pe-lg-5">
                    <div class="row align-items-center">
                        <div class="col-12 mb-4">
                            <div class="box-shadow p-3 rounded">
                                <img src="{{ $service->image_url }}" alt="@lang('website.Image')" class="w-100 rounded" />
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="cover-content text-center text-md-start">
                                <h1 class="fs-3 fw-bold">
                                    {{ $service->name }}
                                </h1>
                                <div class="blog-content mb-4">
                                    <p class="mb-3">
                                        {!! $service->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <form class="mb-2 form parsley-form" action="{{ route('request.store') }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <input type="hidden" name="service_id" value="{{ $service->service_id }}" />
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-2">
                                                <label>الإسم</label>
                                                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'"
                                                    :name="'name'" :placeholder="__('website.name')" :value="old('name')" :isRequired="true"
                                                    :requiredMessage="__('website.name_is_required')" :maxlength="255" :maxlengthMessage="__(
                                                        'website::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label>البريد الإلكترونى</label>
                                                <x-dashboard.form.inputs.email :id="'email'" :class="'form-control'"
                                                    :name="'email'" :emailValidationMessage="__('website.email_must_be_in_email_format')" :placeholder="__('website.email')"
                                                    :value="old('email')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label>@lang('website.phone_number')</label>
                                                <x-dashboard.form.inputs.phone :id="'phone'" :class="'form-control'"
                                                    :name="'phone'" :isRequired="true" :requiredMessage="__('website.phone_is_required')"
                                                    :placeholder="__('website.phone')" :value="old('value')" :phoneValidationMessage="__('website.phone_must_be_in_phone_number_formate')" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>الجنس / النوع</label>
                                                <div class="input-box">
                                                    <select class="niceSelect" name="sex">
                                                        <option>اختر النوع</option>
                                                        <option value="male">ذكر</option>
                                                        <option value="female">أنثى</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($service->type == 'flight')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group mb-2">
                                                    <label>@lang('website.destination_from')</label>
                                                    <x-dashboard.form.inputs.select :id="'from_city_id'" :name="'from_city_id'"
                                                        :class="'niceSelect'" :options="$cities" :isMultiple="false"
                                                        :defaultOptionName="__('website.select_city')" :selectedOption="old('from_city_id')" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-2">
                                                    <label>@lang('website.to')</label>
                                                    <x-dashboard.form.inputs.select :id="'to_city_id'" :name="'to_city_id'"
                                                        :class="'niceSelect'" :options="$cities" :isMultiple="false"
                                                        :defaultOptionName="__('website.select_city')" :selectedOption="old('to_city_id')" />
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary mt-3">@lang('website.register_now')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- Form Parsley Validation -->
    <script src="{{ global_asset('metronic/assets/plugins/parsley/parsley.min.js') }}"></script>
    <!--end::Form Parsley Validation-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
@endpush
