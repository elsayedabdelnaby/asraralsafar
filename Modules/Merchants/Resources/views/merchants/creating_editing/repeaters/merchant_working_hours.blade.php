<div data-repeater-item class="form-group row align-items-top">

    <div class="row">
        {{--start Day--}}
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.day') }} : </label>
                <div class="col-md-6">
                    <x-dashboard.form.inputs.select_week_day
                        :id="'day'"
                        :name="'day'"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.day_is_required')"
                        :placeholder="__('merchants::dashboard.day_is_required')"
                        :selectedOption="$merchant_working_hour['day'] ?? ''"
                    />
                </div>
            </div>
        </div>
        {{--End Day--}}

        {{--Start from--}}
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.from') }} : </label>
                <div class="col-md-6">
                    <x-dashboard.form.inputs.time
                        :id="'from'"
                        :class="'form-control'"
                        :name="'from'"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.from_time_is_required')"
                        :placeholder="__('merchants::dashboard.from_time_is_required')"
                        :value="$merchant_working_hour['from'] ?? ''"
                    />
                </div>
            </div>
        </div>
        {{--End from--}}

        {{--Start to--}}
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.to') }} : </label>
                <div class="col-md-6">
                    <x-dashboard.form.inputs.time
                        :id="'to'"
                        :class="'form-control'"
                        :name="'to'"
                        :isRequired="true"
                        :requiredMessage="__('merchants::dashboard.to_time_is_required')"
                        :placeholder="__('merchants::dashboard.to_time_is_required')"
                        :value="$merchant_working_hour['to'] ?? ''"
                    />
                </div>
            </div>
        </div>
        {{--End to--}}

    </div>

    <div class="row mt-10">
        {{--Start Is Active--}}
        <div class="col-md-4">
            <div class="row align-items-center">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.is_active') }} : </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.success-switch
                        class="mx-2"
                        :id="'merchant_working_hour_is_active'"
                        :name="'merchant_working_hour_is_active'"
                        :isChecked="old('merchant_working_hour_is_active', $merchant->workingHours->is_active ?? '')"
                    />
                </div>
            </div>
        </div>
        {{--End Is Active--}}

        <div class="offset-md-4 col-md-1">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm mt-12 font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('locations::dashboard.delete') }}
            </a>
        </div>
    </div>

</div>
