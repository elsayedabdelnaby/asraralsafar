<?php

namespace Modules\Sales\Actions\CustomerAddresses;

use Modules\Sales\Entities\CustomerAddress;
use Modules\Sales\Http\Requests\CustomerAddresses\ToggleCustomerAddressRequest;

class ToggleCustomerAddressAction
{
    public function handle(ToggleCustomerAddressRequest $request)
    {
        $customerAddress= CustomerAddress::find($request->get("id"));
        $customerAddress->is_default = !$customerAddress->is_default;
        $customerAddress->save();
        CustomerAddress::where('customer_id',$request->get('customer_id'))->whereNotIn('id',[$request->get('id')])->update(['is_default'=>0]);
    }
}
