@extends('dashboard.layouts.app')

@section('title', __('settings::dashboard.delivery_fees'))

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
                            <a href="{{ route('dashboard.settings.delivery_fees.index') }}"
                                class="text-muted">{{ __('settings::dashboard.delivery_fees') }}</a>
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
                <span class="mr-2">
                    <i class="flaticon-truck text-primary"></i>
                </span>
                <h3 class="card-label">{{ __('settings::dashboard.delivery_fees') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('dashboard.settings.delivery_fees.create') }}" class="btn btn-primary font-weight-bolder">
                    <i class="flaticon2-plus-1"></i>
                    {{ __('settings::dashboard.new_delivery_fees') }}</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_delivery_fees"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('settings::dashboard.id') }}</th>
                        <th>{{ __('settings::dashboard.from') }}</th>
                        <th>{{ __('settings::dashboard.to') }}</th>
                        <th>{{ __('settings::dashboard.fees') }}</th>
                        <th>{{ __('settings::dashboard.active') }}</th>
                        <th>{{ __('settings::dashboard.actions') }}</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
    <x-dashboard.modal :id="'delete-delivery-fee'" :size="''">
    </x-dashboard.modal>
@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('settings::delivery_fees.indexing.scripts');
@endpush
