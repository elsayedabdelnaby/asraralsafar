<div data-repeater-item class="form-group  align-items-top">
    <div class="row">
        <!-- Langauge -->
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('locations::dashboard.language') }}
                    : </label>
                <div class="col-md-8">
                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''" />
                    <span
                        class="form-text text-muted">{{ __('locations::dashboard.the_language_of_the_country_translations') }}</span>
                </div>
            </div>
        </div>
        <!--END Langauge -->
        <!--Start Name -->
        <div class="offset-md-1 col-md-4">
            <div class="row">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('locations::dashboard.name') }}:
                </label>
                <div class="col-md-8">
                    <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'merchant_branch_name'"
                        :placeholder="__('locations::dashboard.name')" :value="$translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('locations::dashboard.name_is_required')" :maxlength="50"
                        :maxlengthMessage="__('locations::dashboard.number_of_characters_must_less_than_or_equal_50')" />
                </div>
            </div>
        </div>
        <!-- End Name -->
    </div>
    <div class="row">
        <!--Start address -->
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.address') }}:
                </label>
                <div class="col-md-8">
                    <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'merchant_branch_address'"
                        :placeholder="__('merchants::dashboard.name')" :value="$translation['address'] ?? ''" :isRequired="true" :requiredMessage="__('merchants::dashboard.address_is_required')" :maxlength="50"
                        :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_50')" />
                </div>
            </div>
        </div>
        <!-- End address -->
        <div class=" offset-md-5 col-md-1">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm  font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete') }}
            </a>
        </div>
    </div>

</div>
