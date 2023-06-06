<?php

namespace Modules\Operations\Actions\DeliveryGuys;

use Modules\Operations\Entities\DeliveryGuy;
use Modules\Operations\Http\Requests\DeliveryGuys\DeleteDeliveryGuyRequest;

class DeleteDeliveryGuyAction
{
    /**
     * toggle the status of the customer
     * @param DeleteDeliveryGuyRequest $request
     * @return bool
     */
    public function handle(DeleteDeliveryGuyRequest $request):void
    {
        $delivery_guy = DeliveryGuy::find($request->get("id"));
        $delivery_guy->deliveryGuyCities()->delete();
        $delivery_guy->delete();
    }
}
