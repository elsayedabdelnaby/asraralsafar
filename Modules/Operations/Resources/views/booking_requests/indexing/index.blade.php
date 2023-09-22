@extends('dashboard.layouts.app')

@section('title', __('operations::dashboard.booking_requests'))

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">
                        {{ __('operations::dashboard.booking_requests_management') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.operations.activity-logs.index') }}"
                                class="text-muted">{{ __('operations::dashboard.booking_requests') }}</a>
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
                <h3 class="card-label">{{ __('operations::dashboard.booking_requests') }}</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_booking_requests"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('operations::dashboard.id') }}</th>
                        <th>{{ __('operations::dashboard.name') }}</th>
                        <th>{{ __('operations::dashboard.email') }}</th>
                        <th>{{ __('operations::dashboard.phone') }}</th>
                        <th>{{ __('operations::dashboard.from') }}</th>
                        <th>{{ __('operations::dashboard.to') }}</th>
                        <th>{{ __('operations::dashboard.status') }}</th>
                        <th>{{ __('operations::dashboard.servcie') }}</th>
                        <th>{{ __('operations::dashboard.created_at') }}</th>
                        <th>{{ __('operations::dashboard.updated_at') }}</th>
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
    @include('operations::booking_requests.indexing.scripts')
@endpush
