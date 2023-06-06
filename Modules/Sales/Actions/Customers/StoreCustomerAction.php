<?php

namespace Modules\Sales\Actions\Customers;

use Modules\Sales\Entities\Customer;
use Modules\Sales\Http\Requests\Customers\StoreCustomerRequest;
use Modules\Sales\Services\CustomerService;

/**
 * @purpose create a new customer
 */
class StoreCustomerAction
{

    public function handle(StoreCustomerRequest $request): Customer
    {
        $customerService = new CustomerService();
        return Customer::create($customerService->prepareAttributesToStore($request));
    }
}
