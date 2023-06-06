@extends('dashboard.layouts.app')
@section('head-css')
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
@endsection
@if (isset($merchant_branch))
    @section('title', __('merchants::dashboard.branch_management') . ' - ' . __('merchants::dashboard.edit_branch'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_branch'),
            'short_description' => __('merchants::dashboard.enter_branch_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.social_management') . ' - ' . __('merchants::dashboard.new_branch'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_branch'),
            'short_description' => __('merchants::dashboard.enter_branch_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant_branch) ?  __('merchants::dashboard.edit_branch') :  __('merchants::dashboard.new_branch')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.branches.index', ['merchant_id' => $merchant->id]) }}"
                   class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}
                </a>
                </a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">

                @include('merchants::merchants.creating_editing.partials.wizard_body.merchant_branches')
                @include('merchants::merchants.creating_editing.partials.wizard_body.merchant_branch_manger')

            </div>


            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('locations::dashboard.save') }}
                    </button>
                    <a href="{{ route('dashboard.merchants.branches.index', ['merchant_id' => $merchant->id])}}"
                       class="btn font-weight-bold btn-secondary">
                        {{ __('locations::dashboard.cancel') }}
                    </a>
                </div>

        </form>

        <!--end::Form-->
    </div>
@endsection

@push('javascript')
    <!-- Form Parsley Validation -->
    <script src="{{ global_asset('metronic/assets/plugins/parsley/parsley.min.js') }}"></script>
    <!--end::Form Parsley Validation-->
    <!-- Form JS -->
    <script src="{{ global_asset('js/form.js') }}"></script>
    <!--end::Form JS-->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=&v=weekly"></script>
    <!-- Custom JS -->
    @include('merchants::merchant_branches.creating_editing.scripts')
    @include('merchants::merchants.creating_editing.scripts.google_map')
    <!--end::Custom JS-->
@endpush
