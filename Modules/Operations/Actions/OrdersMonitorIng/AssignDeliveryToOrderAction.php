<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;

use App\Console\Commands\RedisSubscribe;
use Modules\Operations\Http\Requests\OrdersMonitoring\CheckOrderToAssignDeliveryRequest;
use Modules\Sales\Entities\Order;

class AssignDeliveryToOrderAction
{
    public function handle(CheckOrderToAssignDeliveryRequest $request)
    {

        //Assign Order To This Delivery
        $order = Order::find($request->get('order_id'));
        $order->update(['delivery_id'=>$request->get('delivery_id')]);

        //Current Balance For Delivery
        $order->delivery->deliveryGuyInfo->update([
            'current_balance'=> $order->delivery->deliveryGuyInfo->current_balance + $order->total
        ]);


        (new RedisSubscribe())->publisherOrderChangeStatus($order->id);
    }
}
