<h2 class="mb-6 p-6 bg-secondary rounded">{{ __('merchants::dashboard.merchant_general_info') }}:</h2>
<div id="kt_merchant_info_translation_repeater">
    <div class="form-group">
        <div data-repeater-list="merchant_translations">
            @forelse (old('merchant_translations',isset($merchant->translations) ? collect($merchant->translations)->toArray() : []) as $merchant_translation)
                @include(
                    'merchants::merchants.creating_editing.repeaters.merchant_info_translations',
                    $merchant_translation)
            @empty
                @include('merchants::merchants.creating_editing.repeaters.merchant_info_translations', [])
            @endforelse
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-md-10 col-md-2">
            <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
            </a>
        </div>
    </div>
</div>

<div class="row">

    <!-- Start Merchant order_minimum_amount -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.order_minimum_amount') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.number :id="'order_minimum_amount'" :class="'form-control'" :name="'order_minimum_amount'" :isDecimal="true"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.order_minimum_amount')" :integerValidationMessage="__('merchants::dashboard.order_minimum_amount_must_be_integer')" :placeholder="__('merchants::dashboard.order_minimum_amount')" :value="old('order_minimum_amount', $merchant->order_minimum_amount ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant order_minimum_amount -->

    <!-- Start Merchant minimum_delivery_charges -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.minimum_delivery_charges') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.number :id="'minimum_delivery_charges'" :class="'form-control'" :name="'minimum_delivery_charges'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.minimum_delivery_charges')" :integerValidationMessage="__('merchants::dashboard.minimum_delivery_charges_must_be_integer')" :placeholder="__('merchants::dashboard.minimum_delivery_charges')"
                    :value="old('minimum_delivery_charges', $merchant->minimum_delivery_charges ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant minimum_delivery_charges -->

    <!-- Start Merchant average_delivery_time -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.average_delivery_time') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.number :id="'average_delivery_time'" :class="'form-control'" :name="'average_delivery_time'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.average_delivery_time')" :integerValidationMessage="__('merchants::dashboard.order_minimum_amount_must_be_integer')" :placeholder="__('merchants::dashboard.average_delivery_time')"
                    :value="old('average_delivery_time', $merchant->average_delivery_time ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant average_delivery_time -->

    <!-- Start Merchant maximum_distance -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.maximum_distance') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.number :id="'maximum_distance'" :class="'form-control'" :name="'maximum_distance'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.maximum_distance')" :integerValidationMessage="__('merchants::dashboard.maximum_distance_must_be_integer')" :placeholder="__('merchants::dashboard.maximum_distance')"
                    :value="old('maximum_distance', $merchant->maximum_distance ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant maximum_distance -->

    <!-- Start Merchant hot_line -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.hot_line') }}
                : </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.number :id="'hot_line'" :class="'form-control'" :name="'hot_line'"
                    :isDecimal="true" :isRequired="true" :requiredMessage="__('merchants::dashboard.hot_line')" :integerValidationMessage="__('merchants::dashboard.hot_line_must_be_integer')" :placeholder="__('merchants::dashboard.hot_line')"
                    :value="old('hot_line', $merchant->hot_line ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant hot_line -->
    <!-- Merchant Rush time status -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.rush_time_additional_fees') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'rush_time_additional_fees'" :class="'form-control'" :name="'rush_time_additional_fees'"
                    :integerValidationMessage="__('merchants::dashboard.rush_time_additional_fees')" :placeholder="__('merchants::dashboard.rush_time_additional_fees')" :value="old('rush_time_additional_fees', $merchant->rush_time_additional_fees ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant Rush time status -->
</div>

<div class="row mt-15">
    <!-- Merchant Active -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}:
            </label>
            <div class="col-md-6">
                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'merchant_is_active'" :name="'merchant_is_active'"
                    :isChecked="old('merchant_is_active', $merchant->is_active ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant Active -->

    <!-- Merchant has_branches -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.has_branches') }}:
            </label>
            <div class="col-md-6">
                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'has_branches'" :name="'has_branches'"
                    :isChecked="old('has_branches', $merchant->has_branches ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant has_branches -->

    <!-- Merchant has_branches -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.working_status') }}:
            </label>
            <div class="col-md-6">
                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'working_status'" :name="'working_status'"
                    :isChecked="old('working_status', $merchant->working_status ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant has_branches -->

    <!-- Merchant has deliveres -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.has_deliveries') }}:
            </label>
            <div class="col-md-6">
                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'has_deliveries'" :name="'has_deliveries'"
                    :isChecked="old('has_deliveries', $merchant->has_deliveries ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant has deliveres -->

    <!-- Merchant Rush time status -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.rush_time_active') }}:
            </label>
            <div class="col-md-6">
                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'rush_time_status'" :name="'rush_time_status'"
                    :isChecked="old('rush_time_status', $merchant->rush_time_status ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant Rush time status -->
</div>

<div class="row mt-15">
    <!--Start Merchant Logo -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.logo') }}:
            </label>
            <div class="col-md-6">
                <div class="image-input image-input-empty image-input-outline"
                    style="background-image: url('{{ $merchant->logo_url ?? global_asset('metronic/assets/media/users/blank.png') }}')"
                    id="merchant_image">
                    <div class="image-input-wrapper"></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                        data-action="change" data-toggle="tooltip" title=""
                        data-original-title="{{ __('settings::dashboard.change_image') }}">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="merchant_image" accept=".png, .jpg, .jpeg, .svg" />
                        <input type="hidden" name="image_remove" />
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
    </div>
    <!--END Merchant Logo -->
    <!--Start Merchant Notes -->
    <div class="col-md-8">
        <div class="row align-items-center">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.notes') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'" :name="'notes'"
                    :placeholder="__('merchants::dashboard.notes')" :value="old('notes', $merchant->notes ?? '')" />
            </div>
        </div>
    </div>
    <!--END Merchant Notes -->
</div>

<div class="separator separator-solid my-5"></div>
<h2 class="mb-10 p-6 bg-secondary rounded">{{ __('merchants::dashboard.merchant_category') }}:</h2>
<div class="row">
    {{-- Start merchant_working_types   --}}
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold"> {{ __('merchants::dashboard.merchant_types') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.select :id="'merchant_types'" :name="'merchant_types[]'" :isRequired="true"
                    :options="$merchant_types" :requiredMessage="__('merchants::dashboard.merchant_types')" :isMultiple="true" :defaultOptionName="__('merchants::dashboard.select_merchant_type')" :selectedOption="old(
                        'merchant_types',
                        isset($merchant)
                            ? collect($merchant->categoryTypes)
                                ->pluck('category_id')
                                ->toArray()
                            : '',
                    )" />
            </div>
        </div>
    </div>
    {{-- End merchant_working_types   --}}
    {{-- Start merchant_category_items   --}}
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">
                {{ __('merchants::dashboard.merchant_category_items') }}: </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.select :id="'merchant_category_items'" :name="'merchant_category_items[]'" :isRequired="true"
                    :options="$merchant_category_items" :requiredMessage="__('merchants::dashboard.merchant_category_items')" :isMultiple="true" :defaultOptionName="__('merchants::dashboard.select_merchant_category_items')" :selectedOption="old(
                        'merchant_category_items',
                        isset($merchant)
                            ? collect($merchant->categoryItems)
                                ->pluck('category_id')
                                ->toArray()
                            : '',
                    )" />
            </div>
        </div>
    </div>
    {{-- End merchant_category_items   --}}
    {{-- Start merchant_cuisines   --}}
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">
                {{ __('merchants::dashboard.merchant_cuisines') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.select :id="'merchant_cuisines'" :name="'merchant_cuisines[]'" :isRequired="true"
                    :options="$merchant_cuisines" :requiredMessage="__('merchants::dashboard.merchant_cuisines')" :isMultiple="true" :defaultOptionName="__('merchants::dashboard.select_merchant_cuisines')" :selectedOption="old(
                        'merchant_cuisines',
                        isset($merchant)
                            ? collect($merchant->categoryCuisines)
                                ->pluck('category_id')
                                ->toArray()
                            : '',
                    )" />
            </div>
        </div>
    </div>
    {{-- End merchant_cuisines   --}}
    {{-- Start merchant_meals   --}}
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold"> {{ __('merchants::dashboard.merchant_meals') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.select :id="'merchant_meals'" :name="'merchant_meals[]'" :isRequired="true"
                    :options="$merchant_meals" :requiredMessage="__('merchants::dashboard.merchant_meals')" :isMultiple="true" :defaultOptionName="__('merchants::dashboard.select_merchant_meals')" :selectedOption="old(
                        'merchant_meals',
                        isset($merchant)
                            ? collect($merchant->categoryMeals)
                                ->pluck('category_id')
                                ->toArray()
                            : '',
                    )" />
            </div>
        </div>
    </div>
    {{-- End merchant_meals   --}}
</div>
