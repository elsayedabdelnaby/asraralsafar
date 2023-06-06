<?php

namespace Modules\Operations\Actions\DeliveryGuys;

use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Entities\DeliveryGuyCity;
use Modules\Operations\Http\Requests\DeliveryGuys\UpdateDeliveryGuyRequest;
use Modules\Operations\Services\DeliveryGuyService;

class UpdateDeliveryGuyAction
{
    public function handle(UpdateDeliveryGuyRequest $request)
    {
        //Create Delivery Guy
        $deliveryGuyService = new DeliveryGuyService();
        $deliveryGuy        = DeliveryGuy::find($request->get('id'));
        $deliveryGuy->update($deliveryGuyService->prepareAttributes($request));
        $deliveryGuy->deliveryGuyInfo->update($deliveryGuyService->prepareDeliveryGuyAttributes($request,$deliveryGuy));
        //Delete|Create  Delivery Guy Cities Related To
        $deliveryGuy->deliveryGuyCities()->delete();
        DeliveryGuyCity::insert($deliveryGuyService->prepareDeliveryGuyCities($request, $deliveryGuy->id));
    }
}
