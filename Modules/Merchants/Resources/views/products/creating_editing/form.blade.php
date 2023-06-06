@extends('dashboard.layouts.app')

@if (isset($merchant_product))
    @section('title', __('merchants::dashboard.product_management') . ' - ' . __('merchants::dashboard.edit_product'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_product'),
            'short_description' => __('merchants::dashboard.enter_product_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.product_management') . ' - ' . __('merchants::dashboard.new_product'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_product'),
            'short_description' => __('merchants::dashboard.enter_product_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($merchant_product) ?  __('merchants::dashboard.edit_product') :  __('merchants::dashboard.new_product')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.products.index', ['merchant_id' => $merchant->id]) }}"
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

                <div id="kt_translation_repeater">
                    <!-- Translations -->
                    <div class="form-group">
                        <div data-repeater-list="translations">
                            @forelse (old('translations', isset($merchant_product->translations) ? collect($merchant_product->translations)->toArray() : []) as $translation)
                                @include('merchants::products.creating_editing.translation', $translation)
                            @empty
                                @include('merchants::products.creating_editing.translation', [])
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


                    <!-- Start Of Category Type  -->
                    <div class="forctm-group row">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.product_related') }} :</label>
                                <div class="col-md-7">
                                    <x-dashboard.form.inputs.select
                                        :id="'category_type_id'"
                                        :name="'category_type_id'"
                                        :isRequired="true"
                                        :options="$product_category_type"
                                        :requiredMessage="__('merchants::dashboard.product_related_is_required')"
                                        :isMultiple="false"
                                        :defaultOptionName="__('merchants::dashboard.select_category_type_items')"
                                        :selectedOption="old('category_type_id',isset($merchant_product) ? $merchant_product->category_type_id : '')"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.product_category') }}:</label>
                                <div class="col-md-7">
                                    <select
                                        name="category_id[]"
                                        id="category_id"
                                        class="form-control select2"
                                        required
                                        multiple="multiple"
                                        data-parsley-required-message="{{__('merchants::dashboard.product_category_is_required')}}">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Of Category Type -->

                    <!-- Start Activation Mode-->
                    <div class="row mt-15">
                        <!-- Active -->
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('locations::dashboard.is_active') }} : </label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'"
                                                                            :name="'is_active'" :isChecked="old('is_active', $merchant_product->is_active ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <!--END Active -->

                        <!--Start accept_additions -->
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <label class="col-md-6 col-form-label font-weight-bold">{{ __('merchants::dashboard.accept_additions') }} :</label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.success-switch class="mx-2" :id="'accept_additions'"
                                                                            :name="'accept_additions'" :isChecked="old('accept_additions', $merchant_product->accept_additions ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <!--End accept_additions -->

                    </div>
                    <!-- End Activation Mode-->

                    <!-- Start Image -->
                    <div class="form-group row mt-15">
                        <!-- End Main Logo -->
                        <label class="col-lg-2 col-form-label text-left">{{ __('settings::dashboard.image') }}</label>
                        <div class="col-lg-2">
                            <div class="image-input image-input-empty image-input-outline" style="background-image: url('{{ $merchant_product->image_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                                 id="image">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                       data-action="change" data-toggle="tooltip" title=""
                                       data-original-title="{{ __('settings::dashboard.change_image') }}">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg"/>
                                    <input type="hidden" name="image_remove"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel" data-toggle="tooltip"
                                      title="{{ __('settings::dashboard.cancel_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="remove" data-toggle="tooltip"
                                      title="{{ __('settings::dashboard.remove_image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <!-- End Image -->


                    <!--Start Product Type -->
                    <div class="form-group row mt-15">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.product_type') }} :
                                </label>
                                <div class="col-md-8">
                                    <select name="type" id="type"
                                            required data-parsley-required-message="{{__('merchants::dashboard.product_type_is_required')}}"
                                            class="form-control">
                                            <option @if(old('type',$merchant_product->type ?? '') == 'simple') selected @endif value="simple">simple</option>
                                            <option @if(old('type',$merchant_product->type ?? '') == 'variant') selected @endif value="variant">variant</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Product Type -->

                    <!--Start Pricing -->
                    <div id="simple" class="form-group row">
                        <!-- Price  -->
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.price') }}
                                    : </label>
                                <div class="col-md-9">
                                    <x-dashboard.form.inputs.text
                                        :id="'price'"
                                        :class="'form-control'"
                                        :name="'price'"
                                        :placeholder="__('merchants::dashboard.price')"
                                        :value="old('price', $merchant_product->price ?? '')"
                                        :isRequired="false"
                                        data-parsley-pattern-message="{{ __('merchants::dashboard.price_is_required') }}"
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- END Price  -->

                        <!-- discount_price  -->
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.discount_price') }}
                                    : </label>
                                <div class="col-md-8">
                                    <x-dashboard.form.inputs.text
                                        :id="'discount_price'"
                                        :class="'form-control'"
                                        :name="'discount_price'"
                                        :placeholder="__('merchants::dashboard.discount_price')"
                                        :value="old('discount_price', $merchant_product->discount_price ?? '')"
                                        :isRequired="false"
                                        data-parsley-pattern-message="{{ __('merchants::dashboard.discount_price_is_required') }}"
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- END discount_price  -->

                    </div>
                    <!--End Pricing -->
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
    @include('merchants::products.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
