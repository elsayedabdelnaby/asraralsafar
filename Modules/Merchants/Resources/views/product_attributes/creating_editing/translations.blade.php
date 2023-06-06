<div data-repeater-item class="form-group row align-items-top">
    <!-- Langauge -->
    <div class="col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.language') }}: </label>
            <div class="col-md-9">
                <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''" />
                <span
                    class="form-text text-muted">{{ __('merchants::dashboard.the_language_of_the_product_attribute_translations') }}</span>
            </div>
        </div>
    </div>
    <!--END Langauge -->

    <!-- Name -->
    <div class="offset-md-1 col-md-4">
        <div class="row">
            <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.name') }}:
            </label>
            <div class="col-md-9">
                <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'" :placeholder="__('merchants::dashboard.name')"
                    :value="$translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('merchants::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255')" />
            </div>
        </div>
    </div>
    <!-- End Name -->

    <div class=" offset-md-9 col-md-1">
        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
            <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete') }}
        </a>
    </div>

</div>
