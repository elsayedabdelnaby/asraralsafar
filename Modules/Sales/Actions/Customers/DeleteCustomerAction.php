<?php

namespace Modules\Sales\Actions\Customers;

use App\Services\DeleteFile;
use Modules\Sales\Entities\Customer;
use Modules\Sales\Http\Requests\Customers\DeleteCustomerRequest;

/**
 * @purpose delete a customer
 */
class DeleteCustomerAction
{
    /**
     * @param DeleteCustomerRequest $request
     * @return Boolean
     */
    public function handle(DeleteCustomerRequest $request): bool
    {
        $customer = Customer::findOrFail($request->id);
        $customer->image_profile ? DeleteFile::delete($customer->image_profile, 'public', 'sales/customers') : '';
        return $customer->delete();
    }
}
