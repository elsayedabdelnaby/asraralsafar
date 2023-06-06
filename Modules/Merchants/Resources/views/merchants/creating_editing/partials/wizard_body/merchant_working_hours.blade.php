<h2 class="mt-10 mb-10">{{__('merchants::dashboard.merchant_working_hours')}}</h2>

<div id="kt_merchant_working_hours_repeater">
    <div class="form-group">
        <div data-repeater-list="merchant_social">

            @forelse (old('merchant_working_hours') ?? [] as $merchant_working_hour)
                @include('merchants::merchants.creating_editing.repeaters.merchant_working_hours',$merchant_working_hour)
            @empty
                @include('merchants::merchants.creating_editing.repeaters.merchant_working_hours',[])
            @endforelse

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

