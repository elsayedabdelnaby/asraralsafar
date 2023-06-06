<?php

namespace Modules\Merchants\Actions\DeliveryFees;

use Modules\Merchants\Entities\MerchantDeliveryFee;
use Modules\Merchants\Http\Requests\DeliveryFees\StoreDeliveryFeesRequest;

class StoreDeliveryFeeAction
{
    public function handle(StoreDeliveryFeesRequest $request)
    {
        MerchantDeliveryFee::create([
            'from'=> $request->get('merchant_fees_from'),
            'to'=> $request->get('merchant_fees_to'),
            'fees'=> $request->get('merchant_fees'),
            'merchant_id' => $request->get('merchant_id'),
        ]);
    }
}
