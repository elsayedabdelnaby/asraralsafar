<?php

namespace Modules\Merchants\Actions\DeliveryFees;

use Modules\Merchants\Entities\MerchantDeliveryFee;
use Modules\Merchants\Http\Requests\DeliveryFees\DeleteDeliveryFeesRequest;

class DeleteDeliveryFeeAction
{
    public function handle(DeleteDeliveryFeesRequest $request)
    {
        MerchantDeliveryFee::find($request->get("id"))->delete();
    }
}
