<div data-repeater-item>
    <div class="row align-items-center">
        <!-- Langauge -->
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.language') }}
                    :</label>
                <div class="col-md-9">
                    <x-dashboard.form.inputs.language-select :selectedOption="$item['language_id'] ?? ''"/>
                    <span class="form-text text-muted">{{ __('merchants::dashboard.the_language_of_the_product_attribute_translations') }}</span>
                </div>
            </div>
        </div>
        <!--END Langauge -->
        <!-- Name -->
        <div class="col-md-4">
            <div class="row">
                <label
                    class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.name') }}:
                </label>
                <div class="col-md-9">
                    <x-dashboard.form.inputs.text
                        :id="'name'"
                        :class="'form-control'"
                        :name="'name'"
                        :placeholder="__('merchants::dashboard.name')"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.name_is_required')"
                        :maxlength="255"
                        :value="$item['name'] ?? ''"
                        :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255',)"
                    />
                </div>
            </div>
        </div>
        <!-- End Name -->
        <div class="col-2 text-center">
            <a href="javascript:;" data-repeater-delete=""
               class="btn btn-sm font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete_translation') }}
            </a>
        </div>
    </div>
</div>
