@extends('dashboard.layouts.app')

@section('title', __('website::dashboard.blogs'));

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('website::dashboard.website') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.website.blogs.index') }}"
                                class="text-muted">{{ __('website::dashboard.blogs') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fab fa-blogger icon-lg text-primary"></i>
                </span>
                <h3 class="card-label">{{ __('website::dashboard.blogs') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('dashboard.website.blogs.create') }}" class="btn btn-primary font-weight-bolder">
                    <i class="flaticon2-plus-1"></i>
                    {{ __('website::dashboard.new_blog') }}</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_blogs"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('website::dashboard.id') }}</th>
                        <th>{{ __('website::dashboard.title') }}</th>
                        <th>{{ __('website::dashboard.short_description') }}</th>
                        <th>{{ __('website::dashboard.category') }}</th>
                        <th>{{ __('website::dashboard.likes_number') }}</th>
                        <th>{{ __('website::dashboard.sharings_number') }}</th>
                        <th>{{ __('website::dashboard.views_number') }}</th>
                        <th>{{ __('website::dashboard.active') }}</th>
                        <th>{{ __('website::dashboard.actions') }}</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('website::blogs.indexing.scripts');
@endpush
