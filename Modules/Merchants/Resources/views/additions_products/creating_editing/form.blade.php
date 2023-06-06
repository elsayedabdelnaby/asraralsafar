@extends('dashboard.layouts.app')

@if(isset($merchant_additions_product))
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.edit_merchant_additions_products'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_merchant_additions_products'),
            'short_description' => __('merchants::dashboard.enter_merchant_additions_products_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.new_merchant_additions_products'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_merchant_additions_products'),
            'short_description' => __('merchants::dashboard.enter_merchant_additions_products_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant_additions_product) ? __('merchants::dashboard.edit_merchant_additions_products') :  __('merchants::dashboard.new_merchant_additions_products')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.additions-products.index',['merchant_id'=>$merchant->id]) }}"
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
                <div id="kt_repeater">
                    <!-- Translations -->
                    <div class="form-group">
                        <div data-repeater-list="translations">
                            @forelse (old('translations', isset($merchant_additions_product->translations) ? collect($merchant_additions_product->translations)->toArray() : []) as $translation)
                                @include('merchants::additions_products.creating_editing.translations', $translation)
                            @empty
                                @include('merchants::additions_products.creating_editing.translations', [])
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
                        <!-- Price -->
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.price') }}: </label>
                                <div class="col-md-9">
                                     <x-dashboard.form.inputs.text
                                         :id="'price'"
                                         :class="'form-control'"
                                         :name="'price'"
                                         :isRequired="true"
                                         :requiredMessage="__('merchants::dashboard.price_is_required')"
                                         :placeholder="__('merchants::dashboard.price_is_required')"
                                         :value="old('price',$merchant_additions_product->price ?? '',
                                    )" />
                                </div>
                            </div>
                        </div>
                        <!-- END Price -->

                        <!-- Price Discount-->
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.discount_price') }}: </label>
                                <div class="col-md-9">
                                     <x-dashboard.form.inputs.text
                                         :id="'discount_price'"
                                         :class="'form-control'"
                                         :name="'discount_price'"
                                         :requiredMessage="__('merchants::dashboard.discount_price_is_required')"
                                         :placeholder="__('merchants::dashboard.discount_price_is_required')"
                                         :value="old('discount_price',$merchant_additions_product->discount_price ?? '',
                                    )" />
                                </div>
                            </div>
                        </div>
                        <!-- END Price -->
                    </div>

                    <!-- Active -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label
                                    class="col-md-4 col-form-label font-weight-bold">{{ __('locations::dashboard.is_active') }}:
                                </label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'is_active'"
                                        :name="'is_active'"
                                        :isChecked="old('is_active', $merchant_additions_product->is_active ?? '')"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END Active -->
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('merchants::dashboard.save') }}
                    </button>
                    <a
                        href="{{ route('dashboard.merchants.additions-products.index',['merchant_id'=>$merchant->id])}}"
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
    @include('merchants::additions_products.creating_editing.scripts')

@endpush
