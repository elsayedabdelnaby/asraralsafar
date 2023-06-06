<h2 class="mb-6 p-6 bg-secondary rounded">{{ __('merchants::dashboard.merchant_branch') }}:</h2>
<div id="kt_merchant_branch_manager_repeater">
    <div class="form-group">
        <div data-repeater-list="merchant_branch_translations">
            @forelse (old('merchant_branch_translations', isset($merchant_branch->translations) ? collect($merchant_branch->translations)->toArray() : []) as $translation)
                @include(
                    'merchants::merchants.creating_editing.repeaters.merchant_branch_translations',
                    $translation)
            @empty
                @include(
                    'merchants::merchants.creating_editing.repeaters.merchant_branch_translations',
                    []
                )
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

<div class="row mb-6">
    <!-- Start Countries -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.countries') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.select :id="'country_id'" :name="'country_id'" :options="$countries" :isMultiple="false"
                    :isRequired="true" :requiredMessage="__('merchants::dashboard.country_is_required')" :defaultOptionName="__('merchants::dashboard.select_country')" :selectedOption="old('country_id', '')" />
            </div>
        </div>
    </div>
    <!-- End Countries -->
    <!-- Start State -->
    <div class="offset-md-1 col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.state') }}:
            </label>
            <div class="col-md-8">
                <select class="form-control select2" name="state_id" id="state_id"></select>
            </div>
        </div>
    </div>
    <!-- End State -->
    <!-- Start City -->
    <div class="col-md-4">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.city') }}:
            </label>
            <div class="col-md-8">
                <select class="form-control select2" name="city_id" id="city_id"></select>
            </div>
        </div>
    </div>
    <!-- End Countries -->
</div>

<div class="row">
    <!-- Start Latitude -->
    <div class="col-md-4">
        <div class="row">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.latitude') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'branch_latitude'" :class="'form-control'" :name="'branch_latitude'" :placeholder="__('merchants::dashboard.latitude')"
                    :value="old('branch_latitude')" :readonly="true" :isRequired="true" :value="old('branch_latitude', $merchant_branch->latitude ?? '')" :requiredMessage="__('merchants::dashboard.latitude_is_required')"
                    :maxlength="50" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_50')" />
            </div>
        </div>
    </div>
    <!-- End Latitude -->
    <!-- Start longitude -->
    <div class="offset-md-1 col-md-4">
        <div class="row">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.longitude') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'branch_longitude'" :class="'form-control'" :name="'branch_longitude'"
                    :placeholder="__('merchants::dashboard.longitude')" :value="old('branch_longitude', $merchant_branch->longitude ?? '')" :isRequired="true" :readonly="true" :requiredMessage="__('merchants::dashboard.longitude_is_required')"
                    :maxlength="50" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_50')" />
            </div>
        </div>
    </div>
    <!-- End longitude -->
    <!-- Start Merchant Branch Active -->
    <div class="col-md-3">
        <div class="row align-items-center">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}:
            </label>
            <div class="col-md-6">
                <x-dashboard.form.inputs.success-switch class="mx-2" :id="'merchant_branch_is_active'" :name="'merchant_branch_is_active'"
                    :isChecked="old('merchant_branch_is_active', $merchant_branch->is_active ?? '')" />
            </div>
        </div>
    </div>
    <!-- End Merchant Branch Active -->
</div>

<div class="row mt-12">
    <div id="map">

    </div>
</div>
