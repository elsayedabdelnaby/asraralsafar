<?php

namespace Modules\Sales\Actions\Orders;

use App\Models\User;
use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Entities\DeliveryGuyCity;
use Modules\Sales\Entities\Customer;
use Modules\Sales\Entities\CustomerAddress;

class GetAllDeliveryGuysAction
{

    public function handle()
    {
        return DeliveryGuyCity::with('deliveryGuy')
            ->get()
            ->map(function ($query) {
                return [
                    'id' => $query->deliveryGuy->id,
                    'name' => $query->deliveryGuy->name
                ];
            });
    }
}
