@extends('dashboard.layouts.app')

@section('title', __('sales::dashboard.orders'))

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('sales::dashboard.orders_management') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.sales.orders.index') }}"
                                class="text-muted">{{ __('sales::dashboard.orders') }}</a>
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
                <h3 class="card-label">{{ __('sales::dashboard.orders') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                @if (Auth()->user()->hasPermission('create-order'))
                    <a href="{{ route('dashboard.sales.orders.create') }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="fas fa-plus"></i>
                        </span>{{ __('sales::dashboard.new_order') }}
                    </a>
                @endif
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_orders"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('sales::dashboard.id') }}</th>
                        <th>{{ __('sales::dashboard.merchant') }}</th>
                        <th>{{ __('sales::dashboard.branch') }}</th>
                        <th>{{ __('sales::dashboard.customer') }}</th>
                        <th>{{ __('sales::dashboard.delivery') }}</th>
                        <th>{{ __('sales::dashboard.total') }}</th>
                        <th>{{ __('sales::dashboard.coupon') }}</th>
                        <th>{{ __('sales::dashboard.status') }}</th>
                        <th>{{ __('sales::dashboard.actions') }}</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>


@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('sales::orders.indexing.scripts');
@endpush
