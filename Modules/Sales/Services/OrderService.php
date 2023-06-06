<?php

namespace Modules\Sales\Services;

use Modules\Sales\Http\Requests\Orders\StoreOrderRequest;
use Modules\Sales\Http\Requests\Orders\UpdateOrderRequest;

class OrderService
{

    /**
     * @param StoreOrderRequest $request
     * @return array
     */
    public function prepareAttributesToStore(StoreOrderRequest $request): array
    {
        return [
            'merchant_branch_id' => $request->branch_id,
            'coupon_code' => $request->coupon_code,
            'customer_id' => $request->customer_id,
            'address_id' => $request->address_id,
            'delivery_id' => $request->delivery_id ?? null,
            'payment_method' => $request->payment_method,
            'order_status_id'=>$request->order_status_id
        ];
    }

    /**
     * @param UpdateOrderRequest $request
     * @return array
     */
    public function prepareAttributesToUpdate(UpdateOrderRequest $request): array
    {
        return [
            'id' => $request->id,
            'coupon_code' => $request->coupon_code,
            'address_id' => $request->address_id,
            'payment_method' => $request->payment_method,
            'customer_id' => $request->customer_id,
            'delivery_id' => $request->delivery_id ?? null,
            'order_status_id' => $request->order_status_id,
        ];
    }
}
