@extends('website::website.layouts.master')

@section('content')
    <!-- BreadCrumb -->
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
                    <h1 class="mb-3 fs-2">{{ __('website.terms_conditions') }}</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href={{ url('/') }}#">{{ __('website.home page') }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="dot-overlay"></div>
    </section>
    <!-- BreadCrumb -->

    <!-- About detail Start -->
    <section class="faq-main pb-6 pt-6">
        <div class="container">
            <div class="section-title mb-6 text-start mx-auto">
                <h2 class="mb-1 fs-2">
                    {{ __('website.look_at') }}<span class="theme"> {{ __('website.terms_conditions') }}</span>
                </h2>
            </div>
            <div class="faq-accordian">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="accrodion-grp faq-accrodion" data-grp-name="faq-accrodion1">
                            @foreach ($terms_conditions as $term_condition)
                                @if ($loop->first)
                                    <div class="accrodion active">
                                        <div class="accrodion-title">
                                            <h5>{{ $term_condition->title }}</h5>
                                        </div>
                                        <div class="accrodion-content" style="display: block">
                                            <div class="inner">
                                                <p>
                                                    {{ $term_condition->description }}
                                                </p>
                                            </div>
                                            <!-- /.inner -->
                                        </div>
                                    </div>
                                @else
                                    <div class="accrodion">
                                        <div class="accrodion-title">
                                            <h5>{{ $term_condition->title }}</h5>
                                        </div>
                                        <div class="accrodion-content" style="display: none">
                                            <div class="inner">
                                                <p>
                                                    {{ $term_condition->description }}
                                                </p>
                                            </div>
                                            <!-- /.inner -->
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About detail Ends -->
@endsection

@push('js')
    <script src="{{ global_asset('website/js/custom-accordian.js') }}"></script>
@endpush
