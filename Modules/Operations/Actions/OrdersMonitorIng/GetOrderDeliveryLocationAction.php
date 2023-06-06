<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;

use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderValidationRequest;
use Modules\Sales\Entities\Order;

class GetOrderDeliveryLocationAction
{
    public function handle(CheckOrderValidationRequest $request)
    {
        return Order::find($request->get('id'))->address->join('city_translations', 'city_translations.city_id', 'customer_addresses.city_id')->select([
            'city_translations.name as city_name',
            'latitude',
            'longitude',
            'phone_number',
            'address',
            'build_no',
            'floor_no',
            'apartment_no',
            'apartment_no',
        ])->first()->toArray();
    }
}
