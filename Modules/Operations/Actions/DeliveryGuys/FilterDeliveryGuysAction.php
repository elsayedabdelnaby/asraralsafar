<?php

namespace Modules\Operations\Actions\DeliveryGuys;

use Modules\Operations\Entities\DeliveryGuy;

class FilterDeliveryGuysAction
{
    public function handle(array $conditions = null)
    {
        $delivery_guys = DeliveryGuy::where('type', 'delivery_guy');

        if ($conditions) {
            $delivery_guys->where($conditions);
        }

        return $delivery_guys;
    }
}
