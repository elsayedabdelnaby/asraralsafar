@extends('dashboard.layouts.app')

@if (isset($product_variant))
    @section('title', __('merchants::dashboard.product_management') . ' - ' . __('merchants::dashboard.edit_product_variant'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_product_variant'),
            'short_description' => __('merchants::dashboard.enter_product_variant_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.product_management') . ' - ' . __('merchants::dashboard.new_product_variant'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_product_variant'),
            'short_description' => __('merchants::dashboard.enter_product_variant_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($product_variant) ?  __('merchants::dashboard.edit_product_variant') :  __('merchants::dashboard.new_product_variant')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.products-variant.index', ['merchant_id' => $merchant->id,'product_id'=>$product->id]) }}"
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

                <div id="kt_variants_repeater">
                    <!-- Translations -->
                    <div class="form-group">
                        <div data-repeater-list="variants">
                            @forelse (isset($product_variant->attributes) ? collect($product_variant->attributes)->toArray() : []  as $variant)
                                @include('merchants::product_variants.creating_editing.variants_repeater', $variant)
                            @empty
                                @include('merchants::product_variants.creating_editing.variants_repeater', [])
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

                    <div class="row mt-15">
                        <!-- Start Price -->
                        <div class="col-md-4 mt-3">
                            <div class="row align-items-center">
                                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.price') }}
                                    : </label>
                                <div class="col-md-8">
                                    <x-dashboard.form.inputs.text
                                        :class="'form-control'"
                                        :id="'price'"
                                        :name="'price'"
                                        :isDecimal="true"
                                        :isRequired="true"
                                        :requiredMessage="__('merchants::dashboard.price_must_be_inserted')"
                                        :emailValidationMessage="__('merchants::dashboard.price_must_be_inserted')"
                                        :placeholder="__('merchants::dashboard.price')"
                                        :value="old('price',$product_variant->price ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <!-- End Price-->

                        <!-- Active -->
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('locations::dashboard.is_active') }}
                                    :
                                </label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'is_active'"
                                        :name="'is_active'"
                                        :isChecked="old('is_active', $product_variant->is_active ?? '')"
                                    />
                                </div>
                            </div>
                        </div>
                        <!--END Active -->
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit" class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('locations::dashboard.save') }}
                    </button>
                    <a href="{{ route('dashboard.merchants.products.index', ['merchant_id' => $merchant->id])}}"
                       class="btn font-weight-bold btn-secondary">
                        {{ __('locations::dashboard.cancel') }}
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
    @include('merchants::product_variants.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
