@extends('dashboard.layouts.app')

@section('title', __('merchants::dashboard.coupons'))

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('merchants::dashboard.coupons') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ isset($merchant) ? route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant->id]) : route('dashboard.merchants.coupons.index-global')}}" class="text-muted">{{ __('merchants::dashboard.coupons') }}</a>
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
                <h3 class="card-label">{{ __('merchants::dashboard.coupons') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->

                <a href="{{ isset($merchant) ? route('dashboard.merchants.coupons.create', ['merchant_id' => $merchant->id]) : route('dashboard.merchants.coupons.create-global')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <i class="fas fa-plus"></i>
                    </span>{{ __('merchants::dashboard.new_coupon') }}
                </a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>{{ __('merchants::dashboard.id') }}</th>
                    <th>{{ __('merchants::dashboard.name') }}</th>
                    @if(isset($merchant))<th>{{ __('merchants::dashboard.merchant_name') }}</th> @endif
                    <th>{{ __('merchants::dashboard.code') }}</th>
                    <th>{{ __('merchants::dashboard.type') }}</th>
                    <th>{{ __('merchants::dashboard.value_type') }}</th>
                    <th>{{ __('merchants::dashboard.value') }}</th>
                    <th>{{ __('merchants::dashboard.start_date') }}</th>
                    <th>{{ __('merchants::dashboard.end_date') }}</th>
                    <th>{{ __('merchants::dashboard.limited_usage') }}</th>
                    <th>{{ __('merchants::dashboard.user_max_usage') }}</th>
                    <th>{{ __('merchants::dashboard.min_order') }}</th>
                    <th>{{ __('merchants::dashboard.max_order') }}</th>
                    <th>{{ __('merchants::dashboard.min_shipping') }}</th>
                    <th>{{ __('merchants::dashboard.max_shipping') }}</th>
                    <th>{{ __('merchants::dashboard.status') }}</th>
                    <th>{{ __('merchants::dashboard.one_time') }}</th>
                    <th>{{ __('merchants::dashboard.first_order') }}</th>
                    <th>{{ __('merchants::dashboard.apply_on_cash') }}</th>
                    <th>{{ __('merchants::dashboard.apply_on_card') }}</th>
                    <th>{{ __('merchants::dashboard.is_active') }}</th>
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
    @include('merchants::coupons.indexing.scripts');
@endpush
