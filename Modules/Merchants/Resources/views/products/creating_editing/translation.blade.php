<div data-repeater-item class="form-group  align-items-top">

    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.select_language') }} :
                </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.product_name') }}:
                </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.text :id="'name'" :class="'form-control'" :name="'name'" :placeholder="__('merchants::dashboard.product_name')"
                                                  :value="$translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('merchants::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255')"/>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-15">

        <div class="col-md-8">
            <div class="row">
                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.description') }}:
                </label>
                <div class="col-md-10">
                    <x-dashboard.form.inputs.text-area
                        :id="'description'"
                        :class="'form-control'"
                        :name="'description'"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.description_is_required')"
                        :placeholder="__('merchants::dashboard.description')"
                        :value="$translation['description'] ?? ''"/>
                </div>
            </div>
        </div>
        <div class="offset-1  col-md-2">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm  font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete') }}
            </a>
        </div>

    </div>
</div>
