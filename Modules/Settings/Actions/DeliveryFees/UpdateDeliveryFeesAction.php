<?php

namespace Modules\Settings\Actions\DeliveryFees;

use Modules\Settings\Entities\DeliveryFee;
use Modules\Settings\Services\DeliveryFeesService;
use Modules\Settings\Http\Requests\DeliveryFees\UpdateDeliveryFeesRequest;

/**
 * @purpose update the Currency
 */
class UpdateDeliveryFeesAction
{
    /**
     * @param UpdateDeliveryFeesRequest $request
     */
    public function handle(UpdateDeliveryFeesRequest $request): void
    {
        $deliveryFeesService = new DeliveryFeesService();
        $deliveryFees = DeliveryFee::find($request->get('id'));

        $deliveryFees->update($deliveryFeesService->prepareAttributes($request));
    }
}
