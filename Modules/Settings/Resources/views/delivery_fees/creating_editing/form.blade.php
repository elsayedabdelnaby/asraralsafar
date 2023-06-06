@extends('dashboard.layouts.app')

@if (isset($delivery_fees))
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.edit_delivery_fees'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.edit_delivery_fees'),
            'short_description' => __('settings::dashboard.enter_delivery_fees_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('settings::dashboard.settings') . ' - ' . __('settings::dashboard.create_delivery_fees'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('settings::dashboard.new_delivery_fees'),
            'short_description' => __('settings::dashboard.enter_delivery_fees_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($delivery_fees) ? __('settings::dashboard.edit_delivery_fees') : __('settings::dashboard.new_delivery_fees') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.settings.delivery_fees.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div class="form-group row mt-6">
                    <!-- Deliver From -->
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-md-4 col-form-label font-weight-bold ">{{ __('settings::dashboard.deliver_from') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.number :id="'deliver_from'" :class="'form-control'" :name="'deliver_from'"
                                    :placeholder="__('settings::dashboard.deliver_from')" :value="old('deliver_from', $delivery_fees->from ?? '')" :isRequired="true" :requiredMessage="__('settings::dashboard.deliver_from_is_required')"
                                    :integerValidationMessage="__('settings::dashboard.delivery_from_must_be_integer')" />
                            </div>
                        </div>
                    </div>
                    <!--END Deliver From -->
                    <!-- Deliver To -->
                    <div class="offset-md-1 col-md-4">
                        <div class="row">
                            <label
                                class="col-md-4 col-form-label font-weight-bold ">{{ __('settings::dashboard.deliver_to') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.number :id="'deliver_to'" :class="'form-control'" :name="'deliver_to'"
                                    :placeholder="__('settings::dashboard.deliver_to')" :value="old('deliver_from', $delivery_fees->to ?? '')" :isRequired="true" :requiredMessage="__('settings::dashboard.deliver_to_is_required')"
                                    :integerValidationMessage="__('settings::dashboard.delivery_to_must_be_integer')" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--END Deliver To -->
                <!-- Fees -->
                <div class="form-group row mt-6">
                    <div class="col-md-4">
                        <div class="row">
                            <label class="col-md-4 col-form-label font-weight-bold ">{{ __('settings::dashboard.fees') }}
                                : </label>
                            <div class="col-md-8">
                                <x-dashboard.form.inputs.number :id="'fees'" :class="'form-control'" :name="'fees'"
                                    :integerValidationMessage="__('settings::dashboard.fees_must_be_integer')" :placeholder="__('settings::dashboard.fees')" :value="old('fees', $delivery_fees->fees ?? '')" :isRequired="true"
                                    :requiredMessage="__('settings::dashboard.fees_is_required')" />
                            </div>
                        </div>
                    </div>
                    <!--END Fees -->
                    <!--Is Active -->
                    <div class="offset-md-1 col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-md-3 col-form-label font-weight-bold">{{ __('settings::dashboard.is_active') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                                    :isChecked="old('is_active', $delivery_fees->is_active ?? '')" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--END Is Active -->
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('settings::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.settings.categories.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('settings::dashboard.cancel') }}</a>
                    </div>
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
@endpush
