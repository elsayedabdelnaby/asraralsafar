<?php

namespace Modules\Sales\Services;

use Modules\Sales\Entities\OrderStatus;
use Modules\Sales\Http\Requests\OrderStatus\StoreOrderStatusRequest;
use Modules\Sales\Http\Requests\OrderStatus\UpdateOrderStatusRequest;

class OrderStatusService
{

    /**
     * Take a request and return the array of data to create a new customer
     * @param StoreOrderStatusRequest|UpdateOrderStatusRequest $request
     * @return array
     */
    public function prepareAttributesToStore(StoreOrderStatusRequest|UpdateOrderStatusRequest $request): array
    {
        return [
            'color'     => $request->get('color'),
            "is_active" => $request->has('is_active') ? 1 : 0,
        ];
    }

    /**
     * @param StoreOrderStatusRequest $request
     * @return void
     */
    public function prepareAttributesToStoreTranslations(StoreOrderStatusRequest $request, OrderStatus $orderStatus): array
    {
        $attrs_to_insert = [];
        foreach ($request->get('translations') as $translation) {
            $attrs_to_insert[] = [
                'order_status_id' => $orderStatus->id,
                'language_id'     => $translation['language_id'],
                'name'            => $translation['name'],
                'created_at'      => now(),
                'updated_at'      => now()
            ];
        }

        return $attrs_to_insert;
    }
}
