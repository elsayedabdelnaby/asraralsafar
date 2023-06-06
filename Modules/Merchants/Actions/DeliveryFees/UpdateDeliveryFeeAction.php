<?php

namespace Modules\Merchants\Actions\DeliveryFees;

use Modules\Merchants\Entities\MerchantDeliveryFee;
use Modules\Merchants\Http\Requests\DeliveryFees\UpdateDeliveryFeesRequest;

class UpdateDeliveryFeeAction
{
    public function handle(UpdateDeliveryFeesRequest $request)
    {
        $deliveryFee = MerchantDeliveryFee::find($request->get('id'));
        $deliveryFee->from=$request->get('merchant_fees_from');
        $deliveryFee->to=$request->get('merchant_fees_to');
        $deliveryFee->fees=$request->get('merchant_fees');
        $deliveryFee->save();
    }
}
