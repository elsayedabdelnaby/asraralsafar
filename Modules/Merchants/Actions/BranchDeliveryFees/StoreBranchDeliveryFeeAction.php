<?php

namespace Modules\Merchants\Actions\BranchDeliveryFees;

use Modules\Merchants\Entities\MerchantBranchDeliveryFee;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\StoreBranchDeliveryFeesRequest;

class StoreBranchDeliveryFeeAction
{
    public function handle(StoreBranchDeliveryFeesRequest $request)
    {
        MerchantBranchDeliveryFee::create([
            'from'=> $request->get('merchant_fees_from'),
            'to'=> $request->get('merchant_fees_to'),
            'fees'=> $request->get('merchant_fees'),
            'merchant_branch_id' => $request->get('branch_id'),
        ]);
    }
}
