@extends('dashboard.layouts.app')
@section('head-css')
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
@endsection
@if (isset($merchant))
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' .
        __('merchants::dashboard.edit_merchants'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_merchants'),
            'short_description' => __('merchants::dashboard.enter_merchant_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' .
        __('merchants::dashboard.new_merchants'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_merchants'),
            'short_description' => __('merchants::dashboard.enter_merchant_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant) ? __('merchants::dashboard.edit_merchants') : __('merchants::dashboard.new_merchants') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}
                </a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">

                @include('merchants::merchants.creating_editing.partials.wizard_body.merchant_info')

                @if (!isset($merchant))
                    <div class="separator separator-solid my-5"></div>
                    @include('merchants::merchants.creating_editing.partials.wizard_body.merchant_owner_info')
                    <div class="separator separator-solid my-5"></div>
                    @include('merchants::merchants.creating_editing.partials.wizard_body.merchant_branches')
                    <div class="separator separator-solid my-5"></div>
                    @include('merchants::merchants.creating_editing.partials.wizard_body.merchant_branch_manger')
                @endif


                <div class="card-footer">
                    <div class="float-right mb-3">
                        <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                            {{ __('merchants::dashboard.save') }}
                        </button>
                        <a href="{{ route('dashboard.merchants.index') }}" class="btn font-weight-bold btn-secondary">
                            {{ __('merchants::dashboard.cancel') }}
                        </a>
                    </div>
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

    <!--Start::Google Map JS-->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=&v=weekly"></script>
    {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8YjQ00gET3EIeYOuEbiIbl6VMQTbE8bw"></script> --}}
    <!--End::Google Map JS-->

    <!-- Form JS -->

    @include('merchants::merchants.creating_editing.scripts.repeaters')
    @include('merchants::merchant_branches.creating_editing.scripts')
    @include('merchants::merchants.creating_editing.scripts.google_map')
    <!--end::Custom JS-->
@endpush
