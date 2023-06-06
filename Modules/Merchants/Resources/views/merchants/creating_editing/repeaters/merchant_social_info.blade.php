<div data-repeater-item class="form-group row align-items-top">
    <div class="row">
        {{--start url--}}
        <div class="col-md-4">
            <div class="row align-items-center">
                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.url') }} : </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.url
                        :id="'merchant_social_url'"
                        :class="'form-control'"
                        :name="'merchant_social_url'"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.url_is_required')"
                        :placeholder="__('website::dashboard.url')"
                        :value="old('merchant_social_url')"
                        :urlValidationMessage="__('website::dashboard.url_must_be_in_url_format')"/>
                </div>
            </div>
        </div>
        {{--End url--}}

        {{--Start display--}}
        <div class="col-md-4">
            <div class="row align-items-center">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.display') }} : </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.text
                        :id="'merchant_social_display'"
                        :class="'form-control'"
                        :name="'merchant_social_display'"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.display_is_required')"
                        :placeholder="__('website::dashboard.display_name_is_required')"
                        :value="old('merchant_social_display')"
                        :urlValidationMessage="__('website::dashboard.display_name_is_required')"/>
                </div>
            </div>
        </div>
        {{--End display--}}

        {{--Start Is Active--}}
        <div class="col-md-4">
            <div class="row align-items-center">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }}
                    : </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.success-switch
                        class="mx-2"
                        :id="'merchant_social_is_active'"
                        :name="'merchant_social_is_active'"
                        :isChecked="old('merchant_social_is_active')"
                    />
                </div>
            </div>
        </div>
        {{--End Is Active--}}
    </div>
    <div class="row mt-10">

        {{--Start Image--}}
        <div class="col-md-5">
        <div class="row align-items-center">
            <label
                class="col-md-4 col-form-label font-weight-bold">{{ __('merchants::dashboard.icon') }}:
            </label>
            <div class="col-md-6">
                <div class="image-input image-input-empty image-input-outline"
                     style="background-image: url('{{ global_asset('metronic/assets/media/users/blank.png') }}')"
                     id="merchant_social_image">
                    <div class="image-input-wrapper"></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                           data-action="change" data-toggle="tooltip" title=""
                           data-original-title="{{ __('settings::dashboard.change_image') }}">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="merchant_social_image" accept=".png, .jpg, .jpeg, .svg"/>
                        <input type="hidden" name="image_remove"/>
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          data-action="cancel" data-toggle="tooltip"
                          title="{{ __('settings::dashboard.cancel_image') }}">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          data-action="remove" data-toggle="tooltip"
                          title="{{ __('settings::dashboard.remove_image') }}">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                </div>
            </div>
        </div>
    </div>
        {{--End Image--}}

        <div class="offset-md-4 col-md-1">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('locations::dashboard.delete') }}
            </a>
        </div>

    </div>
</div>
