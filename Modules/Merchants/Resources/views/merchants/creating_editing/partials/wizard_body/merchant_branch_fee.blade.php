<h2 class="mt-10 mb-10">{{__('merchants::dashboard.merchant_branch_fee')}}</h2>

<div id="kt_merchant_branch_fee_repeater">
    <div class="form-group">
        <div data-repeater-list="merchant_branch_fees">
            @include('merchants::merchants.creating_editing.repeaters.merchant_branch_fee')
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-md-10 col-md-2">
            <a href="javascript:;" data-repeater-create=""
               class="btn btn-sm font-weight-bolder btn-light-primary">
                <i class="la la-plus"></i>{{ __('settings::dashboard.add') }}
            </a>
        </div>
    </div>
</div>

