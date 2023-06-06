@extends('dashboard.layouts.app')

@if (isset($main_slider))
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.edit_main_slider'))

    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.edit_main_slider'),
            'short_description' => __('website::dashboard.enter_main_slider_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@else
    @section('title', __('website::dashboard.website') . ' - ' . __('website::dashboard.create_main_slider'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('website::dashboard.new_main_slider'),
            'short_description' => __('website::dashboard.enter_main_slider_details_and_submit'),
            'breadcrumbs' => [],
        ]);
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($main_slider) ? __('website::dashboard.edit_main_slider') : __('website::dashboard.new_main_slider') }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.website.main-sliders.index') }}"
                    class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}</a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">
                <div class="form-group row">
                    <!-- Is Active -->
                    <label class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.is_active') }}</label>
                    <div class="col-1">
                        <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'" :name="'is_active'"
                            :isChecked="old('is_active', $main_slider->is_active ?? '')" />
                    </div>
                    <!-- End Is Active -->
                    <div class="col-1"></div>
                    <!-- Display Order -->
                    <label
                        class="col-1 col-form-label font-weight-bold">{{ __('website::dashboard.display_order') }}</label>
                    <div class="col-2">
                        <x-dashboard.form.inputs.number :id="'display_order'" :class="'form-control'" :name="'display_order'"
                            :integerValidationMessage="__('website::dashboard.display_order_must_be_integer')" :placeholder="__('website::dashboard.display_order')" :value="old('display_order', $main_slider->display_order ?? '')" />
                    </div>
                    <!-- End Display Order -->
                </div>
                <div class="form-group row">
                    <!-- Image -->
                    <label class="col-xl-2 col-lg-2 col-form-label text-left">{{ __('website::dashboard.image') }}</label>
                    <div class="col-lg-2 col-xl-2">
                        <div class="image-input image-input-empty image-input-outline"
                            style="background-image: url('{{ $main_slider->image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                            id="image">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="{{ __('website::dashboard.change_image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg"
                                    @if (!isset($main_slider)) required @endif />
                                <input type="hidden" name="image_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip"
                                title="{{ __('website::dashboard.cancel_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip"
                                title="{{ __('website::dashboard.remove_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                    <!-- End Main Logo -->
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('website::dashboard.save') }}</button>
                        <a href="{{ route('dashboard.website.main-sliders.index') }}"
                            class="btn font-weight-bold btn-secondary">{{ __('website::dashboard.cancel') }}</a>
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
    @include('website::main_sliders.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
