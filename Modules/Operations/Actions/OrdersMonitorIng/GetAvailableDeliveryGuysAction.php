<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;

use Modules\Operations\Entities\DeliveryGuyCity;
use Modules\Operations\Http\Requests\OrdersMonitoring\GetAvailableDeliveryGuysRequest;
use Modules\Sales\Entities\Order;
use \Illuminate\Http\Request;

class GetAvailableDeliveryGuysAction
{
    public function handle(GetAvailableDeliveryGuysRequest|Request $request)
    {
        $order       = Order::find($request->get('id'));
        $orderCityId = $order->address->city_id;
        $orderTotal  = 0;
        if ($order->payment_method == 'cash_on_delivery') {
            $orderTotal = $order->total;
        }

        //Get Delivery Guys That Support This Cities
        return DeliveryGuyCity::join('users', 'users.id', 'delivery_guy_cities.user_id')
            ->join('delivery_guys', 'delivery_guys.user_id', 'users.id')
            ->where('city_id', $orderCityId)
            ->whereRaw("
                $orderTotal+delivery_guys.current_balance <=
                delivery_guys.insurance_amount+IF(delivery_guys.allow_to_exceed = 1,delivery_guys.exceed_amount,0)
            ")->select(['users.id', 'users.name'])->get();
    }
}
