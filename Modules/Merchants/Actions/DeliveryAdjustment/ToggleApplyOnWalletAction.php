<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;

use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\ToggleApplyOnWalletRequest;

class ToggleApplyOnWalletAction
{
    public function handle(ToggleApplyOnWalletRequest $request)
    {
        $deliveryAdjustment= DeliveryAdjustments::find($request->get("id"));
        $deliveryAdjustment->apply_on_pay_from_wallet = !$deliveryAdjustment->apply_on_pay_from_wallet;
        return $deliveryAdjustment->save();
    }
}
