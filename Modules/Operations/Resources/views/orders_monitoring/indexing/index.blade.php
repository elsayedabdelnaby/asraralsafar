@extends('dashboard.layouts.app')
@section('head-css')
    <style>
        #map {
            width: 100%;
            height: 300px;
        }
    </style>
@endsection
@section('title', __('operations::dashboard.orders_monitoring'))

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('operations::dashboard.orders_monitoring') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.sales.orders.index') }}"
                               class="text-muted">{{ __('operations::dashboard.orders_monitoring') }}</a>
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

    @include('operations::orders_monitoring.indexing.partials.delivery_location_modal')
    @include('operations::orders_monitoring.indexing.partials.order_details_modal')
    @include('operations::orders_monitoring.indexing.partials.order_edit_status_modal')
    @include('operations::orders_monitoring.indexing.partials.order_assign_delivery_modal')

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{ __('operations::dashboard.orders_monitoring') }}</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_orders" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>{{ __('operations::dashboard.id') }}</th>
                    <th>{{ __('operations::dashboard.total') }}</th>
                    <th>{{ __('operations::dashboard.payment_method') }}</th>
                    <th>{{ __('operations::dashboard.order_status') }}</th>
                    <th>{{ __('operations::dashboard.branch_name') }}</th>
                    <th>{{ __('operations::dashboard.merchant_name') }}</th>
                    <th>{{ __('operations::dashboard.customer_name') }}</th>
                    <th>{{ __('operations::dashboard.delivery_name') }}</th>
                    <th>{{ __('operations::dashboard.delivery_location') }}</th>
                    <th>{{ __('operations::dashboard.order_details') }}</th>
                    <th>{{ __('operations::dashboard.actions') }}</th>
                </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=&v=weekly"></script>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    @include('operations::orders_monitoring.indexing.scripts.delivery_locations')
    @include('operations::orders_monitoring.indexing.scripts.order_details')
    @include('operations::orders_monitoring.indexing.scripts.socket_io')
    @include('operations::orders_monitoring.indexing.scripts.indexScript')
@endpush
