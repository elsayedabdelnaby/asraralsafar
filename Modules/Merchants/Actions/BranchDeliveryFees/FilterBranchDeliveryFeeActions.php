<?php

namespace Modules\Merchants\Actions\BranchDeliveryFees;

use \Illuminate\Http\Request;
use Modules\Merchants\Entities\MerchantBranchDeliveryFee;

class FilterBranchDeliveryFeeActions
{
    public function handle(Request $request)
    {
        return MerchantBranchDeliveryFee::where('merchant_branch_id',$request->branch_id);
    }
}
