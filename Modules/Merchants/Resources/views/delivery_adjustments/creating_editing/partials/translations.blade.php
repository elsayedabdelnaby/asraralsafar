<div data-repeater-item class="form-group align-items-top">

    <div class="row">
    <!-- Langauge -->
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.language') }}: </label>
                <div class="col-md-8">
                    <x-dashboard.form.inputs.language-select :selectedOption="$translation['language_id'] ?? ''"/>
                    <span
                        class="form-text text-muted">{{ __('merchants::dashboard.the_language_of_the_delivery_adjustment_translations') }}</span>
                </div>
            </div>
        </div>
    <!--END Langauge -->

    <!-- Name -->
        <div class="col-md-4">
            <div class="row">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.name') }}:
                </label>
                <div class="col-md-9">
                    <x-dashboard.form.inputs.text
                        :id="'name'"
                        :class="'form-control'"
                        :name="'name'"
                        :placeholder="__('merchants::dashboard.name')"
                        :value="$translation['name'] ?? ''"
                        :isRequired="true"
                        :requiredMessage="__('locations::dashboard.name_is_required')" :maxlength="50"
                        :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_50')"/>
                </div>
            </div>
        </div>
    <!-- End Name -->

    </div>

    <div class="form-group row mt-10">
        <!-- Description -->
        <div class="col-md-8">
            <div class="row">
                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.description') }} : </label>
                <div class="col-md-10">
                    <x-dashboard.form.inputs.text-area
                            :id="'description'"
                            :class="'form-control'"
                            :name="'description'"
                            :placeholder="__('merchants::dashboard.description')" :value="$translation['description'] ?? ''"
                            :isRequired="true"
                            :requiredMessage="__('merchants::dashboard.description_is_required')"
                    />
                </div>
            </div>
        </div>
        <!--END Description -->

        <div class=" offset-md-1 col-md-1">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('locations::dashboard.delete') }}
            </a>
        </div>
    </div>

</div>
