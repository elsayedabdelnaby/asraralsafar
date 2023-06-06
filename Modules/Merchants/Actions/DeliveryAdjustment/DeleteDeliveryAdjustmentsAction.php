<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;

use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\DeleteDeliveryAdjustmentsRequest;

class DeleteDeliveryAdjustmentsAction
{
    public function handle(DeleteDeliveryAdjustmentsRequest $request)
    {
        $delivery_adjustments =  DeliveryAdjustments::find($request->get('id'));
        $delivery_adjustments->translations()->delete();
        $delivery_adjustments->days()->delete();
        $delivery_adjustments->applying()->delete();
        $delivery_adjustments->delete();
    }
}
