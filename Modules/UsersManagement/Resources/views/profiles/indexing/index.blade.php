@extends('dashboard.layouts.app')

@section('title', __('usersmanagement::dashboard.users_management'));

@section('head-css')
    <link href="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('subheader')
    @include('dashboard.layouts.partials.sub_header', [
        'module_name' => __('dashboard.users_management'),
        'breadcrumbs' => [
            [
                'url' => route('dashboard.users-management.profiles.index'),
                'title' => __('usersmanagement::dashboard.profiles'),
            ],
        ],
    ]);
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="text-primary"></i>
                </span>
                <h3 class="card-label">{{ __('usersmanagement::dashboard.profiles') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('dashboard.users-management.profiles.create') }}"
                    class="btn btn-primary font-weight-bolder">
                    <i class="flaticon2-add "></i>{{ __('usersmanagement::dashboard.new_profile') }}</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_profiles"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('usersmanagement::dashboard.id') }}</th>
                        <th>{{ __('usersmanagement::dashboard.name') }}</th>
                        <th>{{ __('usersmanagement::dashboard.active') }}</th>
                        <th>{{ __('usersmanagement::dashboard.actions') }}</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
    <x-dashboard.modal :id="'deleteProfile'" :size="''">
    </x-dashboard.modal>
@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('usersmanagement::profiles.indexing.scripts');
@endpush
