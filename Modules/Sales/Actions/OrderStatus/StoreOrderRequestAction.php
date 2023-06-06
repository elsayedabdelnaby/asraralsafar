<?php

namespace Modules\Sales\Actions\OrderStatus;

use Modules\Sales\Entities\OrderStatus;
use Modules\Sales\Entities\OrderStatusTranslation;
use Modules\Sales\Http\Requests\OrderStatus\StoreOrderStatusRequest;
use Modules\Sales\Services\OrderStatusService;

/**
 * @purpose create a new customer
 */
class StoreOrderRequestAction
{

    public function handle(StoreOrderStatusRequest $request)
    {
        $orderStatusService = new OrderStatusService();
        $orderStatus        = OrderStatus::create($orderStatusService->prepareAttributesToStore($request));
        OrderStatusTranslation::insert($orderStatusService->prepareAttributesToStoreTranslations($request,$orderStatus));
    }
}
