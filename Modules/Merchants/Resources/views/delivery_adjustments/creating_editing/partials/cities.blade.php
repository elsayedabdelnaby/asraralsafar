<div class="row mt-10  cities_section">
    <!-- Start Countries -->
    <div class="col-md-3">
        <div class="row align-items-center">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.countries') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.select
                    :id="'country_id'"
                    :name="'country_id'"
                    :options="$countries"
                    :isMultiple="false"
                    :isRequired="false"
                    :requiredMessage="__('merchants::dashboard.country_is_required')"
                    :defaultOptionName="__('merchants::dashboard.select_country')" :selectedOption="old('country_id', '')"
                />
            </div>
        </div>
    </div>
    <!-- End Countries -->
    <!-- Start State -->
    <div class="col-md-3">
        <div class="row align-items-center">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.state') }}:
            </label>
            <div class="col-md-8">
                <select class="form-control select2" name="state_id" id="state_id"></select>
            </div>
        </div>
    </div>
    <!-- End State -->
    <!-- Start City from -->
    <div class="col-md-3">
        <div class="row align-items-center">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.city_from') }}:
            </label>
            <div class="col-md-8">
                <select class="form-control select2" name="city_from" id="city_from"></select>
            </div>
        </div>
    </div>
    <!-- End City From -->

    <!-- Start City to -->
    <div class="col-md-3">
        <div class="row align-items-center">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.city_to') }}:
            </label>
            <div class="col-md-8">
                <select class="form-control select2" name="city_to" id="city_to"></select>
            </div>
        </div>
    </div>
    <!-- End City From -->


</div>
