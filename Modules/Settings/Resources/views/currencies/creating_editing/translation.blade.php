<div data-repeater-item class="form-group row align-items-top">

    <div class="col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold ">{{ __('settings::dashboard.language') }}: </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''" />
                <span
                    class="form-text text-muted">{{ __('settings::dashboard.the_language_of_the_currency_name') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold ">{{ __('settings::dashboard.name') }}: </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'" :placeholder="__('settings::dashboard.name')"
                    :value="$translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('settings::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__('settings::dashboard.number_of_characters_must_less_than_or_equal_255')" />
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
            <i class="la la-trash-o"></i>{{ __('settings::dashboard.delete') }}
        </a>
    </div>

</div>
