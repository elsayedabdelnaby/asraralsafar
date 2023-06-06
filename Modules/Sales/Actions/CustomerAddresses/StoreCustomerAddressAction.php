<?php

namespace Modules\Sales\Actions\CustomerAddresses;

use Modules\Sales\Entities\CustomerAddress;
use Modules\Sales\Http\Requests\CustomerAddresses\StoreCustomerAddressRequest;
use Modules\Sales\Services\CustomerAddressService;

class StoreCustomerAddressAction
{
    /**
     * @param StoreCustomerAddressRequest $request
     */
    public function handle(StoreCustomerAddressRequest $request)
    {
        $customerAddressService = new CustomerAddressService();
        $customerAddress = CustomerAddress::create($customerAddressService->prepareAttributesToStoreOrUpdate($request));
        $customerAddressService->setCustomerAddressDefaultAddress($request,$customerAddress->id);
    }
}
