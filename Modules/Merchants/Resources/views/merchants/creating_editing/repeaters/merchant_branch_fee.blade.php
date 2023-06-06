<div data-repeater-item class="form-group row align-items-top">

    <div class="row">
        {{--start Day--}}
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-7 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_branch_fee') }} : </label>
                <div class="col-md-5">
                    <x-dashboard.form.inputs.number
                        :id="'merchant_branch_fees'"
                        :class="'form-control'"
                        :name="'merchant_branch_fees'"
                        :isDecimal="true"
                        :isRequired="false"
                        :requiredMessage="__('merchants::dashboard.merchant_branch_fee')"
                        :integerValidationMessage="__('merchants::dashboard.merchant_branch_fee_must_be_integer')"
                        :placeholder="__('merchants::dashboard.merchant_branch_fee')"
                        :value="old('merchant_branch_fee')"
                    />
                </div>
            </div>
        </div>
        {{--End Day--}}

        {{--merchant_fee_from from--}}
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-3 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_fee_from') }}
                    : </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.number
                        :id="'merchant_branch_fees_from'"
                        :class="'form-control'"
                        :name="'merchant_branch_fees_from'"
                        :isDecimal="true"
                        :isRequired="false"
                        :requiredMessage="__('merchants::dashboard.merchant_branch_fee_from')"
                        :integerValidationMessage="__('merchants::dashboard.merchant_branch_fee_from_must_be_integer')"
                        :placeholder="__('merchants::dashboard.merchant_branch_fee_from')"
                        :value="old('merchant_branch_fee_from')"
                    />
                </div>
            </div>
        </div>
        {{--End merchant_fee_from--}}

        {{--Start to--}}
        <div class="col-md-3">
            <div class="row align-items-center">
                <label class="col-md-2 col-form-label font-weight-bold">{{ __('merchants::dashboard.merchant_branch_fee_to') }}
                    : </label>
                <div class="col-md-7">
                    <x-dashboard.form.inputs.number
                        :id="'merchant_branch_fees_to'"
                        :class="'form-control'"
                        :name="'merchant_branch_fees_to'"
                        :isDecimal="true"
                        :isRequired="false"
                        :requiredMessage="__('merchants::dashboard.merchant_branch_fee_to')"
                        :integerValidationMessage="__('merchants::dashboard.merchant_branch_fee_to_must_be_integer')"
                        :placeholder="__('merchants::dashboard.merchant_fee_to')"
                        :value="old('merchant_branch_fee_to')"
                    />
                </div>
            </div>
        </div>
        {{--End to--}}

        <div class="col-md-3">
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                <i class="la la-trash-o"></i>{{ __('locations::dashboard.delete') }}
            </a>
        </div>
    </div>


</div>
