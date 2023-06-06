<?php

namespace Modules\Sales\Actions\OrderStatus;

use Modules\Sales\Entities\Customer;
use Modules\Sales\Entities\OrderStatus;
use Modules\Sales\Http\Requests\OrderStatus\ToggleOrderStatusRequest;

class ToggleOrderStatusAction
{
    /**
     * toggle the status of the customer
     * @param ToggleOrderStatusRequest $request
     * @return bool
     */
    public function handle(ToggleOrderStatusRequest $request): bool
    {
        $orderStatus = OrderStatus::find($request->get("id"));
        $orderStatus->is_active = !$orderStatus->is_active;
        return $orderStatus->save();
    }
}
