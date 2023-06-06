<?php

namespace Modules\Sales\Actions\Customers;

use Modules\Sales\Entities\Customer;
use Modules\Sales\Services\CustomerService;
use Modules\Sales\Http\Requests\Customers\UpdateCustomerRequest;

/**
 * @purpose edit a customer
 */
class UpdateCustomerAction
{

    public function handle(UpdateCustomerRequest $request): Customer
    {
        $customerService = new CustomerService();
        $customer = Customer::find($request->get("id"));
        $customer->update($customerService->preparettributesToUpdate($request));
        return $customer;
    }
}
