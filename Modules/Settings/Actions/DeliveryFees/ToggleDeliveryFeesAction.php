<?php

namespace Modules\Settings\Actions\DeliveryFees;

use Illuminate\Http\Request;
use Modules\Settings\Entities\DeliveryFee;

/**
 * @purpose toggle the Currency status
 */
class ToggleDeliveryFeesAction
{
    /**
     * @param Request $request
     * return boolean
     * @return bool
     */
    public function handle(Request $request): bool
    {
        $delivery_fees = DeliveryFee::find($request->id);

        $delivery_fees->is_active = !$delivery_fees->is_active;

        return $delivery_fees->save();
    }
}
