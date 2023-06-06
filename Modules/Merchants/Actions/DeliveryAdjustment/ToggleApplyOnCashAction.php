<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;

use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\ToggleApplyOnCashRequest;

class ToggleApplyOnCashAction
{
    public function handle(ToggleApplyOnCashRequest $request)
    {
        $deliveryAdjustment= DeliveryAdjustments::find($request->get("id"));
        $deliveryAdjustment->apply_on_cash_on_delivery = !$deliveryAdjustment->apply_on_cash_on_delivery;
        return $deliveryAdjustment->save();
    }
}
