<?php

namespace Modules\Sales\Actions\CustomerAddresses;

use Modules\Sales\Entities\CustomerAddress;
use Modules\Sales\Http\Requests\CustomerAddresses\UpdateCustomerAddressRequest;
use Modules\Sales\Services\CustomerAddressService;

class UpdateCustomerAddressAction
{
    /**
     * @param UpdateCustomerAddressRequest $request
     */
    public function handle(UpdateCustomerAddressRequest $request)
    {
        $customerAddressService = new CustomerAddressService();
        $customerAddress = CustomerAddress::find($request->get('id'));
        $customerAddress->update($customerAddressService->prepareAttributesToStoreOrUpdate($request,$customerAddress));
        $customerAddressService->setCustomerAddressDefaultAddress($request,$customerAddress->id);
    }
}
