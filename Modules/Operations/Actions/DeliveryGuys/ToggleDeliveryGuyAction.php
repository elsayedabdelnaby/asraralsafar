<?php

namespace Modules\Operations\Actions\DeliveryGuys;

use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Http\Requests\DeliveryGuys\ToggleDeliveryGuyRequest;


class ToggleDeliveryGuyAction
{
    /**
     * toggle the status of the customer
     * @param ToggleDeliveryGuyRequest $request
     * @return bool
     */
    public function handle(ToggleDeliveryGuyRequest $request): bool
    {
        $deliveryGuy = DeliveryGuy::find($request->get("id"));
        $deliveryGuy->is_active = !$deliveryGuy->is_active;
        return $deliveryGuy->save();
    }
}
