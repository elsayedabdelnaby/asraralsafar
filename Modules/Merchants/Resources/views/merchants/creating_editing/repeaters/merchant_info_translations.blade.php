<div data-repeater-item class="form-group row align-items-top">
    <!-- Langauge -->
    <div class="col-md-4">
        <div class="row">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.language') }}: </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.language-select :selectedOption="$merchant_translation['language_id'] ?? ''" />
                <span
                    class="form-text text-muted">{{ __('merchants::dashboard.the_language_of_the_merchant_translations') }}</span>
            </div>
        </div>
    </div>
    <!--END Langauge -->
    <!-- Name -->
    <div class="offset-1 col-md-4">
        <div class="row">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.name') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'merchant_name'" :class="'form-control title-input'" :name="'merchant_name'" :placeholder="__('merchants::dashboard.name')"
                    :value="$merchant_translation['name'] ?? ''" :isRequired="true" :requiredMessage="__('merchants::dashboard.name_is_required')" :maxlength="255" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255')" />
            </div>
        </div>
    </div>
    <!-- End Name -->
    <!-- Slug -->
    <div class="col-md-4">
        <div class="row">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.slug') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="''" :class="'form-control slug-input'" :name="'slug'"
                    :placeholder="__('website::dashboard.slug')" :value="$merchant_translation['slug'] ?? ''" :isRequired="true" :requiredMessage="__('merchants::dashboard.slug_is_required')" :maxlength="255"
                    :maxlengthMessage="__('website::dashboard.number_of_characters_must_less_than_or_equal_255')" />
            </div>
        </div>
    </div>
    <!-- END Slug -->
    <!-- Rush Time Message -->
    <div class="offset-md-1 col-md-4">
        <div class="row">
            <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.rush_time_message') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text :id="'rush_time_message'" :class="'form-control'" :name="'rush_time_message'"
                    :placeholder="__('merchants::dashboard.rush_time_message')" :value="$merchant_translation['rush_time_message'] ?? ''" :maxlength="255" :maxlengthMessage="__('merchants::dashboard.number_of_characters_must_less_than_or_equal_255')" />
            </div>
        </div>
    </div>
    <!-- End Rush Time Message -->
    <!-- Meta Info -->
    <div class="col-12 my-6">
        <div class="row">
            <!-- Meta Title -->
            <div class="col-md-4">
                <div class="row">
                    <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.meta_title') }}:
                    </label>
                    <div class="col-md-8">
                        <x-dashboard.form.inputs.meta-title :id="''" :class="'form-control'" :value="$merchant_translation['meta_title'] ?? ''" />
                    </div>
                </div>
            </div>
            <!-- END Meta Title -->
            <!-- Meta Description -->
            <div class="offset-md-1 col-md-4">
                <div class="row">
                    <label class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.meta_description') }}:
                    </label>
                    <div class="col-md-8">
                        <x-dashboard.form.inputs.meta-description :id="''" :class="'form-control'"
                            :isRequired="true" :value="$merchant_translation['meta_description'] ?? ''" />
                    </div>
                </div>
            </div>
            <!-- END Meta Description -->
        </div>
    </div>
    <!-- END Meta Info -->
    <!-- Description -->
    <div class="col-md-8">
        <div class="row">
            <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.description') }}:
            </label>
            <div class="col-md-8">
                <x-dashboard.form.inputs.text-area :id="''" :class="'form-control rtf'" :name="'description'"
                    :placeholder="__('settings::dashboard.description')" :value="$translation['description'] ?? ''" />
            </div>
        </div>
    </div>
    <!-- End Descriptions -->
    <div class=" col-md-1">
        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm  font-weight-bolder btn-light-danger">
            <i class="la la-trash-o"></i>{{ __('merchants::dashboard.delete') }}
        </a>
    </div>
</div>
