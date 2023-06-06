@extends('dashboard.layouts.app')

@section('title', __('usersmanagement::dashboard.users_management'));

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('usersmanagement::dashboard.users_management') }}
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard.users-management.users.index') }}"
                                class="text-muted">{{ __('usersmanagement::dashboard.users') }}</a>
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
                    <i class="flaticon2-user text-primary"></i>
                </span>
                <h3 class="card-label">{{ __('usersmanagement::dashboard.users') }}</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('dashboard.users-management.users.create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
                            <defs></defs>
                            <g id="Stockholm-icons-/-Communication-/-Add-user" stroke="none" stroke-width="1"
                                fill="none" fill-rule="evenodd">
                                <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                <path
                                    d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                    id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path
                                    d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                    id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>{{ __('usersmanagement::dashboard.new_user') }}</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_users"
                style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>{{ __('usersmanagement::dashboard.id') }}</th>
                        <th>{{ __('usersmanagement::dashboard.name') }}</th>
                        <th>{{ __('usersmanagement::dashboard.email') }}</th>
                        <th>{{ __('usersmanagement::dashboard.role') }}</th>
                        <th>{{ __('usersmanagement::dashboard.active') }}</th>
                        <th>{{ __('usersmanagement::dashboard.actions') }}</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
    <x-dashboard.modal :id="'editPassword'" :size="''">
    </x-dashboard.modal>
    <x-dashboard.modal :id="'deleteUser'" :size="''">
    </x-dashboard.modal>
@endsection

@push('javascript')
    <script src="{{ global_asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @include('usersmanagement::users.indexing.scripts');
@endpush
