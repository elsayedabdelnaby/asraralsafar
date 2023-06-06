<?php

namespace Modules\Operations\Actions\OrdersMonitorIng;


use App\Console\Commands\RedisSubscribe;
use Modules\Operations\Http\Requests\OrdersMonitoring\UpdateOrderChangeStatusRequest;
use Modules\Sales\Entities\Order;

class UpdateOrderChangeStatusAction
{
    public function handle(UpdateOrderChangeStatusRequest $request)
    {
        $order                  = Order::find($request->get('order_id'));
        $order->order_status_id = $request->get('status_id');
        $order->save();

        (new RedisSubscribe())->publisherOrderChangeStatus($order->id);
    }
}
