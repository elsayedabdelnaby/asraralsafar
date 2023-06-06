<div data-repeater-item class="form-group row align-items-top">

    <div class="col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.select_language') }}:
            </label>
            <div class="col-md-7">
                <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''" />
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_name') }}:
            </label>
            <div class="col-md-10">
                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'" :placeholder="__('merchants::dashboard.merchant_name')"
                    :value="$translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('merchants::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255')" />
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
            <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete') }}
        </a>
    </div>

</div>
