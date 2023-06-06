<?php

namespace Modules\Merchants\Actions\BranchDeliveryFees;

use Modules\Merchants\Entities\MerchantBranchDeliveryFee;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\UpdateBranchDeliveryFeesRequest;


class UpdateBranchDeliveryFeeAction
{
    public function handle(UpdateBranchDeliveryFeesRequest $request)
    {
        $deliveryFee = MerchantBranchDeliveryFee::find($request->get('id'));
        $deliveryFee->from=$request->get('merchant_fees_from');
        $deliveryFee->to=$request->get('merchant_fees_to');
        $deliveryFee->fees=$request->get('merchant_fees');
        $deliveryFee->save();
    }
}
