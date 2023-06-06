<?php

namespace Modules\Sales\Actions\Orders;

use Modules\Sales\Entities\Order;
use Modules\Sales\Entities\OrderProduct;
use Modules\Sales\Http\Requests\Orders\DeleteOrderRequest;
use Throwable;

class DeleteOrderAction
{
    /**
     * @throws Throwable
     */
    public function handle(DeleteOrderRequest $request): void
    {
        $order = Order::whereId($request->id)
            ->first();

        throw_if(!in_array($order->status, ['requested', 'approved']),
            new \Exception('Order Can not be deleted once it is approved'));

        // Delete order basic data
        $order->delete();

        // Delete coupon applying data
        OrderProduct::where('order_id', $order->id)
            ->delete();
    }
}
