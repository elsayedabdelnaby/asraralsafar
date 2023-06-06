@extends('dashboard.layouts.app')

@section('title', __('locations::dashboard.states'))

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
                        {{ $country->translation->name . ' ' . __('locations::dashboard.states_management') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.locations.states.index', ['country_id' => $country_id]) }}"
                                class="text-muted">{{ __('locations::dashboard.states') }}</a>
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
                <h3 class="card-label">{{ __('locations::dashboard.states') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                @if (Auth()->user()->hasPermission('create-state'))
                    <a href="{{ route('dashboard.locations.states.create', ['country_id' => $country_id]) }}"
                        class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="fas fa-plus"></i>
                        </span>{{ __('locations::dashboard.new_state') }}
                    </a>
                @endif
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_states"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('locations::dashboard.id') }}</th>
                        <th>{{ __('locations::dashboard.name') }}</th>
                        <th>{{ __('locations::dashboard.country') }}</th>
                        <th>{{ __('locations::dashboard.cities') }}</th>
                        <th>{{ __('locations::dashboard.status') }}</th>
                        <th>{{ __('locations::dashboard.actions') }}</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>


@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('locations::states.indexing.scripts');
@endpush
