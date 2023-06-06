@extends('dashboard.layouts.app')

@section('title', __('operations::dashboard.working_settings') . ' - ' . __('operations::dashboard.working_settings'))

@section('subheader')
    @include('dashboard.layouts.partials.sub_header', [
        'module_name' => __('operations::dashboard.edit_working_settings'),
        'short_description' => __('operations::dashboard.enter_the_system_work_settings'),
        'breadcrumbs' => [],
    ]);
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('operations::dashboard.edit_working_settings') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ URL::previous() }}" class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div id="kt_working_settings_translation_name_repeater">
                    <div class="form-group row">
                        <div data-repeater-list="translations" class="col-lg-10">
                            @foreach ($working_settings->translations as $translation)
                                <div data-repeater-item class="form-group row align-items-top">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('operations::dashboard.language') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.language-select :selectedOption="$translation->language_id" />
                                                <span
                                                    class="form-text text-muted">{{ __('operations::dashboard.the_language_of_the_working_settings') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('operations::dashboard.closing_reason') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                    :name="'closing_reason'" :placeholder="__('operations::dashboard.closing_reason')" :value="old('closing_reason', $merchant->closing_reason ?? '')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <label
                                                class="col-lg-4 col-form-label text-right">{{ __('operations::dashboard.minimum_order_message') }}:</label>
                                            <div class="col-lg-8">
                                                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'"
                                                    :name="'minimum_order_message'" :placeholder="__('operations::dashboard.minimum_order_message')" :value="old(
                                                        'minimum_order_message',
                                                        $merchant->minimum_order_message ?? '',
                                                    )" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="javascript:;" data-repeater-delete=""
                                            class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>{{ __('operations::dashboard.delete') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-9 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('operations::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <!-- Merchant Active -->
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label
                                class="col-md-4 col-form-label font-weight-bold">{{ __('operations::dashboard.is_active') }}:
                            </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_working'" :name="'is_working'"
                                    :isChecked="old('is_working', $merchant->is_active ?? '')" />
                            </div>
                        </div>
                    </div>
                    <!--END Merchant Active -->

                    <!-- Merchant has_branches -->
                    <div class="col-md-4">
                        <div class="row align-items-center">
                            <label
                                class="col-md-4 col-form-label font-weight-bold">{{ __('operations::dashboard.has_branches') }}:
                            </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'has_branches'" :name="'has_branches'"
                                    :isChecked="old('has_branches', $merchant->has_branches ?? '')" />
                            </div>
                        </div>
                    </div>
                    <!--END Merchant has_branches -->
                </div>
                <!-- Pixel Code -->
                <div class="form-group row">
                    <!-- Facebook Pixel Code -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('operations::dashboard.facebook_pixel_code') }}</label>
                    <div class="col-3 col-xl-3 col-lg-3">
                        <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'" :name="'facebook_pixel_code'"
                            :placeholder="__('operations::dashboard.facebook_pixel_code')" :value="$working_settings->facebook_pixel_code" />
                    </div>
                    <!-- End Facebook Pixel Code -->
                    <!-- Google Analytics Code -->
                    <label
                        class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('operations::dashboard.google_analytics_code') }}</label>
                    <div class="col-3 col-xl-3 col-lg-3">
                        <x-dashboard.form.inputs.text-area :id="''" :class="'form-control'" :name="'google_analytics_code'"
                            :placeholder="__('operations::dashboard.google_analytics_code')" :value="$working_settings->google_analytics_code" />
                    </div>
                    <!-- End Google Analytics Code -->
                </div>
                <!-- End Pixel Code -->
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('operations::dashboard.save') }}</button>
                        <a href="{{ URL::previous() }}"
                            class="btn font-weight-bold btn-secondary">{{ __('operations::dashboard.cancel') }}</a>
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
    <!-- Custom JS -->
    @include('operations::information.scripts')
    <!--end::Custom JS-->
@endpush
