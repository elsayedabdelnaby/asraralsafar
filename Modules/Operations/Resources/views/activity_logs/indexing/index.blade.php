@extends('dashboard.layouts.app')

@section('title', __('operations::dashboard.activity_logs'))

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
                        {{ __('operations::dashboard.activity_log_management') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.operations.activity-logs.index') }}"
                                class="text-muted">{{ __('operations::dashboard.activity_log') }}</a>
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
                <h3 class="card-label">{{ __('operations::dashboard.activity_log') }}</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-responsive" id="kt_datatable"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('operations::dashboard.id') }}</th>
                        <th>{{ __('operations::dashboard.description') }}</th>
                        <th>{{ __('operations::dashboard.subject_type') }}</th>
                        <th>{{ __('operations::dashboard.record_id') }}</th>
                        <th>{{ __('operations::dashboard.who') }}</th>
                        <th>{{ __('operations::dashboard.properties') }}</th>
                        <th>{{ __('operations::dashboard.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->subject_type }}</td>
                            <td>{{ $activity->subject_id }}</td>
                            <td>{{ $activity->causer?->email }}</td>
                            <td>{{ $activity->properties }}</td>
                            <td>{{ $activity->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-12">
                    {{ $activities->links('vendor.pagination.views.bootstrap-5') }}
                </div>
            </div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
