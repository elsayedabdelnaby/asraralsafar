<?php

namespace Modules\Sales\Actions\CustomerAddresses;

use Modules\Sales\Entities\CustomerAddress;
use Modules\Sales\Http\Requests\CustomerAddresses\DeleteCustomerAddressRequest;

/**
 * @purpose delete a customer
 */
class DeleteCustomerAddressAction
{
    /**
     * @param DeleteCustomerAddressRequest $request
     * @return Boolean
     */
    public function handle(DeleteCustomerAddressRequest $request):void
    {
        CustomerAddress::find($request->get('id'))->delete();
    }
}
