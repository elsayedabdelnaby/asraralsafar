@extends('dashboard.layouts.app')

@if(isset($delivery_adjustments))
        @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.edit_delivery_adjustments'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.edit_delivery_adjustments'),
            'short_description' => __('merchants::dashboard.enter_merchant_delivery_adjustments_details_and_submit'),
        ]);
    @endsection
@else
    @section('title', __('merchants::dashboard.merchants_management') . ' - ' . __('merchants::dashboard.new_delivery_adjustments'))
    @section('subheader')
        @include('dashboard.layouts.partials.sub_header', [
            'module_name' => __('merchants::dashboard.new_delivery_adjustments'),
            'short_description' => __('merchants::dashboard.enter_merchant_delivery_adjustments_details_and_submit'),
        ]);
    @endsection
@endif
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ isset($delivery_adjustments) ? __('merchants::dashboard.edit_delivery_adjustments') :  __('merchants::dashboard.new_delivery_adjustments')  }}
                    <i class="mr-2"></i>
                    <small class=""></small>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('dashboard.merchants.delivery-adjustments.index') }}"
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
                                @forelse (old('translations', isset($delivery_adjustments->translations) ? collect($delivery_adjustments->translations)->toArray() : []) as $translation)
                                    @include('merchants::delivery_adjustments.creating_editing.partials.translations', $translation)
                                @empty
                                    @include('merchants::delivery_adjustments.creating_editing.partials.translations', [])
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

                    <!-- Start Timing -->
                        <div class="form-group row mt-15">
                            <!-- start date-->
                            <div class="col-md-3">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.start_date') }}: </label>
                                    <div class="col-md-6">
                                        <x-dashboard.form.inputs.date
                                            :id="'start_date'"
                                            :class="'form-control'"
                                            :name="'start_date'"
                                            :isRequired="true"
                                            :requiredMessage="__('merchants::dashboard.start_date_is_required')"
                                            :placeholder="__('merchants::dashboard.start_date_is_required')"
                                            :value="old('start_date', $delivery_adjustments->start_date ?? '' )"/>
                                    </div>
                                </div>
                            </div>
                            <!--End start Time -->

                            <!-- start Time-->
                            <div class="col-md-3">
                                <div class="row">
                                    <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.start_time') }}: </label>
                                    <div class="col-md-6">
                                        <x-dashboard.form.inputs.time
                                            :id="'start_time'"
                                            :class="'form-control'"
                                            :name="'start_time'"
                                            :isRequired="true"
                                            :requiredMessage="__('merchants::dashboard.start_time_is_required')"
                                            :placeholder="__('merchants::dashboard.start_time_is_required')"
                                            :value="old('start_time',isset($delivery_adjustments) ? \Carbon\Carbon::createFromFormat('H:i:s',$delivery_adjustments->start_time)->format('h:i') : '')"/>
                                    </div>
                                </div>
                            </div>
                            <!--End start Time -->


                            <!--Start End date-->
                            <div class="col-md-3">
                                <div class="row">
                                    <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.end_date') }}: </label>
                                    <div class="col-md-6">
                                        <x-dashboard.form.inputs.date
                                            :id="'end_date'"
                                            :class="'form-control'"
                                            :name="'end_date'"
                                            :isRequired="true"
                                            :requiredMessage="__('merchants::dashboard.end_date_is_required')"
                                            :placeholder="__('merchants::dashboard.end_date_is_required')"
                                            :value="old('end_date',$delivery_adjustments->end_date ?? '')"/>
                                    </div>
                                </div>
                            </div>
                            <!--End End Time -->

                            <!--Start end time-->
                            <div class="col-md-3">
                                <div class="row">
                                    <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.end_time') }} : </label>
                                    <div class="col-md-5">
                                        <x-dashboard.form.inputs.time
                                            :id="'end_time'"
                                            :class="'form-control'"
                                            :name="'end_time'"
                                            :isRequired="true"
                                            :requiredMessage="__('merchants::dashboard.end_time_is_required')"
                                            :placeholder="__('merchants::dashboard.end_time_is_required')"
                                            :value="old('end_time',isset($delivery_adjustments) ? \Carbon\Carbon::createFromFormat('H:i:s',$delivery_adjustments->end_time)->format('h:i') : '')"/>
                                    </div>
                                </div>
                            </div>
                            <!--End  time-->
                        </div>
                    <!-- End Timing -->


                    <!-- Start Orders Value Min& Max Attrs -->
                    <div class="form-group row mt-15">
                      <!--Start  minimum_order_value-->
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.minimum_order_value') }}: </label>
                                    <div class="col-md-6">
                                        <x-dashboard.form.inputs.number
                                            :id="'minimum_order_value'"
                                            :class="'form-control'"
                                            :name="'minimum_order_value'"
                                            :isRequired="true"
                                            :requiredMessage="__('merchants::dashboard.minimum_order_value_is_required')"
                                            :integerValidationMessage="__('merchants::dashboard.minimum_order_must_be_integer')"
                                            :placeholder="__('merchants::dashboard.minimum_order_value_is_required')"
                                            :value="old('minimum_order_value',$delivery_adjustments->minimum_order_value ?? '')"/>
                                    </div>
                                </div>
                            </div>
                      <!--End minimum_order_value -->

                      <!--Start  maximum_order_value-->
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.maximum_order_value') }}: </label>
                                    <div class="col-md-6">
                                        <x-dashboard.form.inputs.number
                                            :id="'maximum_order_value'"
                                            :class="'form-control'"
                                            :name="'maximum_order_value'"
                                            :isRequired="true"
                                            :requiredMessage="__('merchants::dashboard.maximum_order_value_is_required')"
                                            :integerValidationMessage="__('merchants::dashboard.maximum_order_must_be_integer')"
                                            :placeholder="__('merchants::dashboard.maximum_order_value_is_required')"
                                            :value="old('maximum_order_value',$delivery_adjustments->maximum_order_value ?? '')"/>
                                    </div>
                                </div>
                            </div>
                      <!--End maximum_order_value -->
                    </div>
                    <div class="form-group row mt-5">
                        <!--Start  minimum_order_value-->
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.minimum_shipping_cost_value') }}: </label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.number
                                        :id="'minimum_shipping_cost_value'"
                                        :class="'form-control'"
                                        :name="'minimum_shipping_cost_value'"
                                        :isRequired="true"
                                        :requiredMessage="__('merchants::dashboard.minimum_shipping_cost_value_value_is_required')"
                                        :integerValidationMessage="__('merchants::dashboard.minimum_shipping_cost_value_must_be_integer')"
                                        :placeholder="__('merchants::dashboard.minimum_shipping_cost_value_value_is_required')"
                                        :value="old('minimum_shipping_cost_value',$delivery_adjustments->minimum_shipping_cost_value ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <!--End minimum_order_value -->

                        <!--Start  maximum_shipping_cost_value-->
                        <div class="col-md-6">
                            <div class="row">
                                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.maximum_shipping_cost_value') }}
                                    : </label>
                                <div class="col-md-6">
                                    <x-dashboard.form.inputs.number
                                        :id="'maximum_shipping_cost_value'"
                                        :class="'form-control'"
                                        :name="'maximum_shipping_cost_value'"
                                        :isRequired="true"
                                        :requiredMessage="__('merchants::dashboard.maximum_shipping_cost_value_is_required')"
                                        :integerValidationMessage="__('merchants::dashboard.maximum_shipping_cost_value_must_be_integer')"
                                        :placeholder="__('merchants::dashboard.maximum_shipping_cost_value_is_required')"
                                        :value="old('maximum_shipping_cost_value',$delivery_adjustments->maximum_shipping_cost_value ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <!--End maximum_shipping_cost_value -->
                    </div>
                    <!-- End Orders Value Min& Max Attrs -->

                    <!-- Start Of Type& Value && Days -->
                        <div class="form-group row mt-15">
                           <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.value_type') }}: </label>
                                <div class="col-md-8">
                                    <select name="value_type" id="value_type" class="form-control">
                                        <option value="percentage">{{__('merchants::dashboard.percentage')}}</option>
                                        <option value="amount">{{__('merchants::dashboard.amount')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                           <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.value') }}: </label>
                                <div class="col-md-8">
                                    <x-dashboard.form.inputs.number
                                        :id="'value'"
                                        :class="'form-control'"
                                        :name="'value'"
                                        :isRequired="true"
                                        :requiredMessage="__('merchants::dashboard.value_is_required')"
                                        :integerValidationMessage="__('merchants::dashboard.value_must_be_integer')"
                                        :placeholder="__('merchants::dashboard.value_is_required')"
                                        :value="old('value',$delivery_adjustments->value ?? '')"/>
                                </div>
                            </div>
                        </div>
                           <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.day') }}: </label>
                                <div class="col-md-9">
                                    <x-dashboard.form.inputs.select_week_day
                                        :id="'day'"  :name="'day[]'"
                                        :isRequired="true"
                                        :isMultiple="true"
                                        :requiredMessage="__('merchants::dashboard.day_is_required')"
                                        :placeholder="__('merchants::dashboard.day_is_required')"
                                        :selectedOption="old('day', isset($delivery_adjustments) ? collect($delivery_adjustments->days)->pluck('day_name')->toArray() : '')"
                                    />
                                </div>
                            </div>
                        </div>
                        </div>
                    <!-- End Of Type& Value && Days -->


                    <!-- Start Of Toggle -->
                        <div class="form-group row col-md-4 mt-15">
                            <div class="row">
                                <label class="col-md-7 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}: </label>
                                <div class="col-md-5">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'is_active'"
                                        :name="'is_active'"
                                        :isChecked="old('is_active', $delivery_adjustments->is_active ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row col-md-4">
                            <div class="row">
                                <label class="col-md-9 col-form-label font-weight-bold">{{ __('merchants::dashboard.apply_on_cash_on_delivery') }}: </label>
                                <div class="col-md-3">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'apply_on_cash_on_delivery'"
                                        :name="'apply_on_cash_on_delivery'"
                                        :isChecked="old('apply_on_cash_on_delivery', $delivery_adjustments->apply_on_cash_on_delivery ?? '')"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row col-md-4">
                            <div class="row">
                                <label class="col-md-9 col-form-label font-weight-bold">{{ __('merchants::dashboard.apply_on_pay_from_wallet') }}: </label>
                                <div class="col-md-3">
                                    <x-dashboard.form.inputs.success-switch
                                        class="mx-2"
                                        :id="'apply_on_pay_from_wallet'"
                                        :name="'apply_on_pay_from_wallet'"
                                        :isChecked="old('apply_on_pay_from_wallet', $delivery_adjustments->apply_on_pay_from_wallet ?? '')"/>
                                </div>
                            </div>
                        </div>
                    <!-- End Of Toggle -->

                    <!-- Start OF  Adjustment Type -->
                        <div class="form-group row">
                            <div class="col-md-3">
                                <div class="row">
                                    <label class="col-md-5 col-form-label font-weight-bold">{{ __('merchants::dashboard.adjustment_type') }}: </label>
                                    <div class="col-md-7">
                                        <select name="type" id="type" class="form-control">
                                            <option value="cities">{{__('merchants::dashboard.cities')}}</option>
                                            <option value="merchants">{{__('merchants::dashboard.merchants')}}</option>
                                            <option value="products">{{__('merchants::dashboard.products')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End OF  Adjustment Type -->
                        @include('merchants::delivery_adjustments.creating_editing.partials.cities')
                        @include('merchants::delivery_adjustments.creating_editing.partials.merchants')
                        @include('merchants::delivery_adjustments.creating_editing.partials.products')
                </div>
            </div>

            <div class="card-footer">
                <div class="float-right mb-3">
                    <button type="submit"
                            class="btn font-weight-bold btn-success mr-2  spinner-white spinner-right">
                        {{ __('locations::dashboard.save') }}
                    </button>
                    <a
                        href="{{ route('dashboard.merchants.delivery-adjustments.index')}}"
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
    <script src="{{ global_asset('js/state.city.filter.js') }}"></script>
    <!--end::Form JS-->
    <!-- Custom JS -->
    @include('merchants::delivery_adjustments.creating_editing.scripts')
    <!--end::Custom JS-->
@endpush
