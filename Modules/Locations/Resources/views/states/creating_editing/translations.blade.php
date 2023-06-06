<div data-repeater-item class="form-group row align-items-top">

    <div class="col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('locations::dashboard.language') }}: </label>
            <div class="col-md-9">
                <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''" />
                <span
                    class="form-text text-muted">{{ __('locations::dashboard.the_language_of_the_state_translations') }}</span>
            </div>
        </div>
    </div>

    <div class="offset-md-1 col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('locations::dashboard.name') }}: </label>
            <div class="col-md-9">
                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'" :placeholder="__('locations::dashboard.name')"
                    :value="$translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('locations::dashboard.name_is_required')" :maxlength="50" :maxlengthMessage="__('locations::dashboard.number_of_characters_must_less_than_or_equal_50')" />
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
            <i class="la la-trash-o"></i>{{ __('locations::dashboard.delete') }}
        </a>
    </div>

</div>
