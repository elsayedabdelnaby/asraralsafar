@extends('dashboard.layouts.app')

@section('title', __('merchants::dashboard.merchants_management'))

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('merchants::dashboard.merchants_management') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.merchants.index') }}" class="text-muted">{{ __('merchants::dashboard.merchants') }}</a>
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
                <h3 class="card-label">{{ __('merchants::dashboard.merchants_management') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->

                <a href="{{ route('dashboard.merchants.create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <i class="fas fa-plus"></i>
                    </span>{{ __('merchants::dashboard.new_merchant') }}
                </a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_merchants" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>{{ __('merchants::dashboard.id') }}</th>
                    <th>{{ __('merchants::dashboard.name')}}</th>
                    <th>{{ __('merchants::dashboard.merchant_branch') }}</th>
                    <th>{{ __('merchants::dashboard.coupons') }}</th>
                    <th>{{ __('merchants::dashboard.working_hours') }}</th>
                    <th>{{ __('merchants::dashboard.social') }}</th>
                    <th>{{ __('merchants::dashboard.reviews') }}</th>
                    <th>{{ __('merchants::dashboard.additions_products') }}</th>
                    <th>{{ __('merchants::dashboard.delivery_fees') }}</th>
                    <th>{{ __('merchants::dashboard.products') }}</th>
                    <th>{{ __('merchants::dashboard.hot_line') }}</th>
                    <th>{{ __('merchants::dashboard.has_branches') }}</th>
                    <th>{{ __('merchants::dashboard.working_status') }}</th>
                    <th>{{ __('merchants::dashboard.minimum_delivery') }}</th>
                    <th>{{ __('merchants::dashboard.minimum_order')}}</th>
                    <th>{{ __('merchants::dashboard.reviews_count')}}</th>
                    <th>{{ __('merchants::dashboard.delivery_time_in_minutes')}}</th>
                    <th>{{ __('merchants::dashboard.maximum_distance')}}</th>
                    <th>{{ __('merchants::dashboard.status') }}</th>
                    <th>{{ __('merchants::dashboard.actions') }}</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('merchants::merchants.indexing.scripts');
@endpush
