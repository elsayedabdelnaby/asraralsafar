<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;

use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\ToggleDeliveryAdjustmentRequest;

class ToggleDeliveryAdjustmentAction
{
    public function handle(ToggleDeliveryAdjustmentRequest $request)
    {
        $deliveryAdjustment= DeliveryAdjustments::find($request->get("id"));
        $deliveryAdjustment->is_active = !$deliveryAdjustment->is_active;
        return $deliveryAdjustment->save();
    }
}
