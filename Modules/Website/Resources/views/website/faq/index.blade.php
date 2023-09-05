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
                    <h1 class="mb-3 fs-2">الأسئلة الشائعة</h1>
                    <nav aria-label="breadcrumb" class="d-block">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-white" href={{ url('/') }}#">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                الأسئلة الشائعة والأجوبة
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
                    تعرف على <span class="theme">الأسئلة الشائعة</span>
                </h2>
                <p class="text-muted">
                    نقدم للزوار الكرام مجموعة من الأسئلة الشائعة بين العملاء و أجوبتها
                </p>
            </div>
            <div class="faq-accordian">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="accrodion-grp faq-accrodion" data-grp-name="faq-accrodion1">
                            @foreach ($faqs as $faq)
                                @if ($loop->first)
                                    <div class="accrodion active">
                                        <div class="accrodion-title">
                                            <h5>{{ $faq->faq_question }}</h5>
                                        </div>
                                        <div class="accrodion-content" style="display: block">
                                            <div class="inner">
                                                <p>
                                                    {{ $faq->faq_answer }}
                                                </p>
                                            </div>
                                            <!-- /.inner -->
                                        </div>
                                    </div>
                                @else
                                    <div class="accrodion">
                                        <div class="accrodion-title">
                                            <h5>{{ $faq->faq_question }}</h5>
                                        </div>
                                        <div class="accrodion-content" style="display: none">
                                            <div class="inner">
                                                <p>
                                                    {{ $faq->faq_answer }}
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
