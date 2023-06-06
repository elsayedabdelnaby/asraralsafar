@extends('dashboard.layouts.app')

@if (isset($product_attribute))
    @section('title', __('merchants::dashboard.products') . ' - ' . __('merchants::dashboard.edit_product_attributes'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_product_attributes'),
            'short_description' => __('merchants::dashboard.enter_product_attribute_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.products') . ' - ' . __('merchants::dashboard.new_product_attribute'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_product_attribute'),
            'short_description' => __('merchants::dashboard.enter_product_attribute_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($product_attribute) ? __('merchants::dashboard.edit_product_attribute') :  __('merchants::dashboard.new_product_attribute')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.products.product-attributes.index') }}"
                   class="btn btn-light-primary font-weight-bolder mr-2">
                    <i class="ki ki-long-arrow-back icon-sm"></i>{{ __('dashboard.back') }}
                </a>
            </div>
        </div>
        <!--begin::Form-->
        <form class="form parsley-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="card-body">

                <div id="kt_product_attribute_translation_repeater">
                    <!-- Translations -->
                    <div class="form-group">
                        <div data-repeater-list="translations">
                            @forelse (old('translations', isset($product_attribute->translations) ? collect($product_attribute->translations)->toArray() : []) as $translation)
                                @include('merchants::product_attributes.creating_editing.translations',$translation)
                            @empty
                                @include('merchants::product_attributes.creating_editing.translations', [])
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-md-10 col-md-2">
                            <a href="javascript:;" data-repeater-create=""
                               class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                    <!-- END Translations -->

                    <div class="form-group row">
                        <!-- Input Type -->
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.input_type') }} : </label>
                                <div class="col-md-9">
                                    <x-dashboard.form.inputs.enum-select
                                        :id="'type'" :name="'type'"
                                        :isRequired="true"
                                        :isMultiple="false"
                                        :options="$types"
                                        :requiredMessage="__('merchants::dashboard.type_is_required')"
                                        :defaultOptionName="__('merchants::dashboard.select_type')"
                                        :selectedOption="old('type',$product_attribute->input_type ?? '')"
                                    />
                                    <span class="form-text text-muted">{{ __('merchants::dashboard.select_the_type_of_attribute') }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- END Input Type -->
                        <!-- Categories -->
                        <div class="offset-md-1 col-md-4">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">
                                    {{ __('merchants::dashboard.categories') }}:
                                </label>
                                <div class="col-md-9">
                                    <x-dashboard.form.inputs.select
                                        :id="'category_id'" :name="'categories_ids[]'"
                                        :options="$categories"
                                        :isMultiple="true" :isRequired="true"
                                        :requiredMessage="__('merchants::dashboard.category_is_required')"
                                        :defaultOptionName="__('merchants::dashboard.select_categories')"
                                        :selectedOption="old('categories_ids', isset($product_attribute) ? collect($product_attribute->categories)->pluck('id')->toArray() :'')"/>
                                </div>
                            </div>
                        </div>
                        <!-- END Categories -->
                    </div>
                    <!-- Active -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}:</label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'is_active'"
                                        :name="'is_active'"
                                        :isChecked="old('is_active', $product_attribute->is_active ?? '')"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END Active -->
                </div>
                <!-- Options -->
                <div class="separator separator-dashed my-5"></div>
                <div class="repeater d-none" id="attribute-options">
                    <div class="row">
                        <div class="col-3 my-5">
                            <h4>{{ __('merchants::dashboard.attribute_options') }}:</h4>
                        </div>
                    </div>
                    <div data-repeater-list="attribute-options">
                        @forelse (isset($product_attribute) ?  $product_attribute->options : []  as $option)
                            @include('merchants::product_attributes.creating_editing.options',$option)
                        @empty
                            @include('merchants::product_attributes.creating_editing.options',[])
                        @endforelse
                    </div>
                    <div class="row my-4">
                        <div class="col-2 offset-md-10">
                            <a href="javascript:;" data-repeater-create=""
                               class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('merchants::dashboard.add_option') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!--END Options -->
            </div>
            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('merchants::dashboard.save') }}
                    </button>
                    <a href="{{ route('dashboard.products.product-attributes.index') }}"
                       class="btn font-weight-bold btn-secondary">
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
    <!-- Custom JS -->
    @include('merchants::product_attributes.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
