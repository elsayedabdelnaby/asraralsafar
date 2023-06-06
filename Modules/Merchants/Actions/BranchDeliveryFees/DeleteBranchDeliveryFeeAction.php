<?php

namespace Modules\Merchants\Actions\BranchDeliveryFees;

use Modules\Merchants\Entities\MerchantBranchDeliveryFee;
use Modules\Merchants\Http\Requests\BranchDeliveryFees\DeleteBranchDeliveryFeesRequest;

class DeleteBranchDeliveryFeeAction
{
    public function handle(DeleteBranchDeliveryFeesRequest $request)
    {
        MerchantBranchDeliveryFee::find($request->get("id"))->delete();
    }
}
