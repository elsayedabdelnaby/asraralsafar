<?php

namespace Modules\Merchants\Actions\DeliveryFees;

use \Illuminate\Http\Request;
use Modules\Merchants\Entities\MerchantDeliveryFee;

class FilterDeliveryFeeActions
{
    public function handle(Request $request)
    {
        return MerchantDeliveryFee::where('merchant_id',$request->merchant_id);
    }
}
