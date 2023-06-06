<?php

namespace Modules\Operations\Actions\DeliveryGuys;

use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Entities\DeliveryGuyCity;
use Modules\Operations\Entities\DeliveryGuyInfo;
use Modules\Operations\Http\Requests\DeliveryGuys\StoreDeliveryGuyRequest;
use Modules\Operations\Services\DeliveryGuyService;

class StoreDeliveryGuyAction
{
    public function handle(StoreDeliveryGuyRequest $request)
    {
        //Create Delivery Guy
        $deliveryGuyService = new DeliveryGuyService();
        $deliveryGuy        = DeliveryGuy::create($deliveryGuyService->prepareAttributes($request));

        //Create Delivery Guy Cities Related To
        DeliveryGuyCity::insert($deliveryGuyService->prepareDeliveryGuyCities($request, $deliveryGuy->id));

        //Create Delivery Guy Full Info
        DeliveryGuyInfo::create($deliveryGuyService->prepareDeliveryGuyAttributes($request,$deliveryGuy));
    }
}
