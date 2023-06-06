@extends('dashboard.layouts.app')

@section('title', __('settings::dashboard.currency'));

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('settings::dashboard.general_settings') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.settings.currencies.index') }}"
                                class="text-muted">{{ __('settings::dashboard.currency') }}
                            </a>
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
                    <i class="fas fa-money-bill-alt text-primary"></i>
                </span>
                <h3 class="card-label">{{ __('settings::dashboard.currency') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('dashboard.settings.currencies.create') }}" class="btn btn-primary font-weight-bolder">
                    <i class="flaticon2-plus-1"></i>
                    {{ __('settings::dashboard.new_currency') }}</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_currencies"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('settings::dashboard.id') }}</th>
                        <th>{{ __('settings::dashboard.name') }}</th>
                        <th>{{ __('settings::dashboard.iso_code') }}</th>
                        <th>{{ __('settings::dashboard.symbol') }}</th>
                        <th>{{ __('settings::dashboard.html_entity') }}</th>
                        <th>{{ __('settings::dashboard.symbol_first') }}</th>
                        <th>{{ __('settings::dashboard.is_main') }}</th>
                        <th>{{ __('settings::dashboard.active') }}</th>
                        <th>{{ __('settings::dashboard.actions') }}</th>
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
    @include('settings::currencies.indexing.scripts');
@endpush
