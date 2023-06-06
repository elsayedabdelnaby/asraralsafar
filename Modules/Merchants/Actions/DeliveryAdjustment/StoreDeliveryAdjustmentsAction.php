<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;
use Modules\Merchants\Entities\DeliveryAdjustmentApplying;
use Modules\Merchants\Entities\DeliveryAdjustmentDay;
use Modules\Merchants\Entities\DeliveryAdjustments;
use Modules\Merchants\Entities\DeliveryAdjustmentTranslation;
use Modules\Merchants\Http\Requests\DeliveryAdjustments\StoreDeliveryAdjustmentsRequest;
use Modules\Merchants\Services\DeliveryAdjustmentsService;
class StoreDeliveryAdjustmentsAction
{
    public function handle(StoreDeliveryAdjustmentsRequest $request): void
    {
        $delivery_adjustments_service = new DeliveryAdjustmentsService();

        //Create Delivery Adjustments
        $delivery_adjustments = DeliveryAdjustments::create($delivery_adjustments_service->prepareAttributes($request));

        //Create Delivery Adjustments Translations
        DeliveryAdjustmentTranslation::insert($delivery_adjustments_service->prepareAttributesTranslations($request,$delivery_adjustments));

        //Create Delivery Adjustments Days
        DeliveryAdjustmentDay::insert($delivery_adjustments_service->prepareAttributesToDays($request,$delivery_adjustments));

        //Create Delivery Adjustments Applying
        DeliveryAdjustmentApplying::insert($delivery_adjustments_service->prepareAttributesApplying($request,$delivery_adjustments));
    }
}
