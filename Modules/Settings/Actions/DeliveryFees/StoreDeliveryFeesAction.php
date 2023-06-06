<?php

namespace Modules\Settings\Actions\DeliveryFees;

use Modules\Settings\Entities\DeliveryFee;
use Modules\Settings\Http\Requests\DeliveryFees\StoreDeliveryFeesRequest;
use Modules\Settings\Services\DeliveryFeesService;

/**
 * handle creation of Currency
 */
class StoreDeliveryFeesAction
{
    /**
     * @param StoreDeliveryFeesRequest $request
     */
    public function handle(StoreDeliveryFeesRequest $request): DeliveryFee
    {
        return DeliveryFee::create(DeliveryFeesService::prepareAttributes($request));
    }
}
