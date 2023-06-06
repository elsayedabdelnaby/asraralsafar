@extends('dashboard.layouts.app')

@if (isset($coupon))
    @section('title', __('merchants::dashboard.coupon_management') . ' - ' . __('merchants::dashboard.edit_coupon'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_coupon'),
            'short_description' => __('merchants::dashboard.enter_coupon_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.coupon_management') . ' - ' . __('merchants::dashboard.new_coupon'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_coupon'),
            'short_description' => __('merchants::dashboard.enter_coupon_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($coupon) ?  __('merchants::dashboard.edit_coupon') :  __('merchants::dashboard.new_coupon')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ isset($merchant) ? route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant->id]) : route('dashboard.merchants.coupons.index-global') }}"
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
                <div id="kt_coupon_translation_repeater">
                    <div data-repeater-list="translations">
                        @forelse (old('translations', $coupon['translations'] ?? []) as $translation)
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.language') }}
                                            :</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.language-select
                                                    :selectedOption="$translation['language_id']"/>
                                            @else
                                                <x-dashboard.form.inputs.language-select
                                                    :selectedOption="$translation->language_id"/>
                                            @endif
                                            <span
                                                class="form-text text-muted">{{ __('merchants::dashboard.the_language_of_the_coupon_details') }}</span>
                                        </div>

                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('merchants::dashboard.name') }}
                                            :</label>
                                        <div class="col-lg-3">
                                            @if (is_array($translation))
                                                <x-dashboard.form.inputs.text :id="''"
                                                                              :class="'form-control name-input'"
                                                                              :name="'name'"
                                                                              :placeholder="__('merchants::dashboard.name')"
                                                                              :value="$translation['name']"
                                                                              :isRequired="true"
                                                                              :requiredMessage="__('merchants::dashboard.name_is_required')"
                                                                              :maxlength="255"
                                                                              :maxlengthMessage="__(
                                                        'merchants::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )"/>
                                            @else
                                                <x-dashboard.form.inputs.text :id="''"
                                                                              :class="'form-control name-input'"
                                                                              :name="'name'"
                                                                              :placeholder="__('merchants::dashboard.name')"
                                                                              :value="$translation->name"
                                                                              :isRequired="true"
                                                                              :requiredMessage="__('merchants::dashboard.name_is_required')"
                                                                              :maxlength="255"
                                                                              :maxlengthMessage="__(
                                                        'merchants::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                    )"/>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-2"></div>
                                <!--end::Separator-->
                            </div>
                        @empty
                            <div data-repeater-item class="row mb-7">
                                <div class="col-12">
                                    <div class="row mb-3">
                                        <label
                                            class="col-lg-1 col-form-label text-center">{{ __('settings::dashboard.language') }}
                                            :</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.language-select :selectedOption="''"/>
                                            <span
                                                class="form-text text-muted">{{ __('merchants::dashboard.the_language_of_the_coupon_details') }}</span>
                                        </div>

                                        <label
                                            class="col-lg-2 col-form-label text-right">{{ __('merchants::dashboard.name') }}
                                            :</label>
                                        <div class="col-lg-3">
                                            <x-dashboard.form.inputs.text :id="''" :class="'form-control name-input'"
                                                                          :name="'name'"
                                                                          :placeholder="__('merchants::dashboard.name')"
                                                                          :value="''" :isRequired="true"
                                                                          :requiredMessage="__('merchants::dashboard.name_is_required')"
                                                                          :maxlength="255" :maxlengthMessage="__(
                                                    'settings::dashboard.number_of_characters_must_less_than_or_equal_255',
                                                )"/>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <a href="javascript:;" data-repeater-delete=""
                                               class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-2"></div>
                                <!--end::Separator-->
                            </div>
                        @endforelse
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-10 col-form-label text-right"></label>
                        <div class="col-lg-2">
                            <a href="javascript:;" data-repeater-create=""
                               class="btn btn-sm font-weight-bolder btn-light-primary">
                                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-md-2 col-form-label font-weight-bold ">{{ __('merchants::dashboard.code') }}
                                : </label>
                            @if(isset($coupon))
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.text :id="'code'" :class="'form-control'" :name="'code'"
                                                                  :placeholder="__('merchants::dashboard.code')"
                                                                  :value="old('code', $coupon['code'] ?? '')"
                                                                  :isRequired="true"
                                                                  :readonly="true"
                                                                  :requiredMessage="__('merchants::dashboard.code_is_required')"
                                                                  :maxlength="6" :maxlengthMessage="__(
                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_10',
                                    )"/>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.text :id="'code'" :class="'form-control'" :name="'code'"
                                                                  :placeholder="__('merchants::dashboard.code')"
                                                                  :value="old('code', $coupon['code'] ?? '')"
                                                                  :isRequired="true"
                                                                  :requiredMessage="__('merchants::dashboard.code_is_required')"
                                                                  :maxlength="6" :maxlengthMessage="__(
                                        'settings::dashboard.number_of_characters_must_less_than_or_equal_10',
                                    )"/>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.type') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.enum-select :id="'type'" :name="'type'"
                                                                     :options="$type"
                                                                     :defaultOptionName="__('merchants::dashboard.select_type')"
                                                                     :selectedOption="old('type', $coupon['type'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.value_type') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.enum-select :id="'value_type'" :name="'value_type'"
                                                                     :options="$value_type"
                                                                     :defaultOptionName="__('merchants::dashboard.select_value_type')"
                                                                     :selectedOption="old('value_type', $coupon['value_type'] ?? '')"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.value') }}</label>
                            <div class="col-6">

                                <x-dashboard.form.inputs.number :id="'value'" :class="'form-control'"
                                                                :name="'value'"
                                                                :integerValidationMessage="__('merchants::dashboard.value_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.value')"
                                                                :value="old('value', $coupon['value'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.starting') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.datetime
                                    :id="'start_date'"
                                    :class="'form-control'"
                                    :name="'start_date'"
                                    :isRequired="true"
                                    :requiredMessage="__('merchants::dashboard.start_date_is_required')"
                                    :placeholder="__('merchants::dashboard.start_date_is_required')"
                                    :value="$coupon['start_date'] ?? ''"
                                />
                                <span
                                    class="form-text text-muted">{{ __('merchants::dashboard.select_the_starting_date_of_coupon') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label
                                class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.ending') }}
                                : </label>
                            <div class="col-md-6">
                                <x-dashboard.form.inputs.datetime
                                    :id="'end_date'"
                                    :class="'form-control'"
                                    :name="'end_date'"
                                    :placeholder="__('merchants::dashboard.end_date_is_required')"
                                    :value="$coupon['end_date'] ?? ''"
                                />
                                <span
                                    class="form-text text-muted">{{ __('merchants::dashboard.select_the_ending_date_of_coupon') }}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant') }}</label>
                            <div class="col-6">
                                @if(isset($coupon['merchant']))
                                    <x-dashboard.form.inputs.select :id="'merchant_id'" :name="'merchant_id'"
                                                                    :options="$merchants"
                                                                    :isMultiple="false"
                                                                    :defaultOptionName="__('merchants::dashboard.select_merchant')"
                                                                    :selectedOption="old('merchant_id', $coupon['merchant']->first()['id'] ?? '')"/>
                                @else
                                    <x-dashboard.form.inputs.select :id="'merchant_id'" :name="'merchant_id'"
                                                                    :options="$merchants"
                                                                    :isMultiple="false"
                                                                    :defaultOptionName="__('merchants::dashboard.select_merchant')"
                                                                    :selectedOption="old('merchant_id', '')"/>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.city') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.select :id="'city_id'" :name="'city_id[]'"
                                                                :options="$cities"
                                                                :isMultiple="true"
                                                                :defaultOptionName="__('merchants::dashboard.select_city')"
                                                                :selectedOption="old('city_id', $coupon['cities'] ?? '')"/>
                                <span
                                    class="form-text text-muted">{{ __('merchants::dashboard.select_the_city_of_coupon') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.branch') }}</label>
                            <div class="col-6">
                                <x-dashboard.form.inputs.select :id="'branch_id'" :name="'branch_id[]'"
                                                                :options="$branches"
                                                                :isMultiple="true"
                                                                :defaultOptionName="__('merchants::dashboard.select_branch')"
                                                                :selectedOption="old('branch_id', $coupon['branches'] ?? '')"/>
                                <span
                                    class="form-text text-muted">{{ __('merchants::dashboard.select_the_branch_of_coupon') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <label
                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.category') }}</label>
                            <div class="col-6">

                                <x-dashboard.form.inputs.select :id="'category_id'" :name="'category_id[]'"
                                                                :options="$categories"
                                                                :isMultiple="true"
                                                                :defaultOptionName="__('merchants::dashboard.select_category')"
                                                                :selectedOption="old('category_id', $coupon['categories'] ?? '')"/>
                                <span
                                    class="form-text text-muted">{{ __('merchants::dashboard.select_the_category_of_coupon') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="row">--}}
                    {{--                            <label--}}
                    {{--                                class="col-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.products') }}</label>--}}
                    {{--                            <div class="col-6">--}}
                    {{--                                <x-dashboard.form.inputs.select :id="'product_id'" :name="'product_id[]'"--}}
                    {{--                                                                :options="$products"--}}
                    {{--                                                                :isMultiple="true"--}}
                    {{--                                                                :defaultOptionName="__('merchants::dashboard.select_product')"--}}
                    {{--                                                                :selectedOption="old('product_id', current($coupon['products']) ?? '')"/>--}}
                    {{--                    <span--}}
                    {{--                        class="form-text text-muted">{{ __('merchants::dashboard.select_the_city_of_coupon') }}</span>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div class="form-group row">

                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.limited_usage') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'limited_usage'" :class="'form-control'"
                                                                :name="'limited_usage'"
                                                                :integerValidationMessage="__('merchants::dashboard.limited_usage_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.limited_usage')"
                                                                :value="old('limited_usage', $coupon['limited_usage'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.user_max_usage') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'user_max_usage'" :class="'form-control'"
                                                                :name="'user_max_usage'"
                                                                :integerValidationMessage="__('merchants::dashboard.user_max_usage_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.user_max_usage')"
                                                                :value="old('user_max_usage', $coupon['user_max_usage'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.min_order') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'min_order'" :class="'form-control'"
                                                                :name="'min_order'"
                                                                :integerValidationMessage="__('merchants::dashboard.min_order_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.min_order')"
                                                                :value="old('min_order', $coupon['min_order'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.max_order') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'max_order'" :class="'form-control'"
                                                                :name="'max_order'"
                                                                :integerValidationMessage="__('merchants::dashboard.max_order_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.max_order')"
                                                                :value="old('max_order', $coupon['max_order'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.min_shipping') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'min_shipping'" :class="'form-control'"
                                                                :name="'min_shipping'"
                                                                :integerValidationMessage="__('merchants::dashboard.min_shipping_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.min_shipping')"
                                                                :value="old('min_shipping', $coupon['min_shipping'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.max_shipping') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.number :id="'max_shipping'" :class="'form-control'"
                                                                :name="'max_shipping'"
                                                                :integerValidationMessage="__('merchants::dashboard.max_shipping_must_be_integer')"
                                                                :placeholder="__('merchants::dashboard.max_shipping')"
                                                                :value="old('max_shipping', $coupon['max_shipping'] ?? '')"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.first_order') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'first_order'"
                                                                        :name="'first_order'"
                                                                        :isChecked="old('first_order', $coupon['first_order'] ?? '')"
                                                                        data-invisible-row-id="display_order_in_website_row"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.one_time') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'one_time'"
                                                                        :name="'one_time'"
                                                                        :isChecked="old('one_time', $coupon['one_time'] ?? '')"
                                                                        data-invisible-row-id="display_order_in_website_row"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.apply_on_cash') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'apply_on_cash'"
                                                                        :name="'apply_on_cash'"
                                                                        :isChecked="old('apply_on_cash', $coupon['apply_on_cash'] ?? '')"
                                                                        data-invisible-row-id="display_order_in_website_row"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.apply_on_card') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'apply_on_card'"
                                                                        :name="'apply_on_card'"
                                                                        :isChecked="old('apply_on_card', $coupon['apply_on_card'] ?? '')"
                                                                        data-invisible-row-id="display_order_in_website_row"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <label
                                class="col-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}</label>
                            <div class="col-4">
                                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'is_active'"
                                                                        :name="'is_active'"
                                                                        :isChecked="old('is_active', $coupon['is_active'] ?? '')"
                                                                        data-invisible-row-id="display_order_in_website_row"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button type="submit"
                                class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">{{ __('settings::dashboard.save') }}</button>
                        <a href="{{ isset($merchant) ? route('dashboard.merchants.coupons.index', ['merchant_id' => $merchant->id]) : route('dashboard.merchants.coupons.index-global')}}"
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
    <!-- Custom JS -->
    @include('merchants::coupons.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
