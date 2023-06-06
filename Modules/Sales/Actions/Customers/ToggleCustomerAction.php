<?php

namespace Modules\Sales\Actions\Customers;

use Modules\Sales\Entities\Customer;
use Modules\Sales\Http\Requests\Customers\ToggleCustomerRequest;

class ToggleCustomerAction
{
    /**
     * toggle the status of the customer
     * @param ToggleCustomerRequest $request
     * @return bool
     */
    public function handle(ToggleCustomerRequest $request): bool
    {
        $customer = Customer::find($request->get("id"));
        $customer->is_active = !$customer->is_active;
        return $customer->save();
    }
}
