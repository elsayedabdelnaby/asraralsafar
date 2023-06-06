<?php

namespace Modules\Sales\Actions\Customers;

use Modules\Sales\Entities\Customer;

/**
 * @purpose get all customers with a specific type and status
 */
class GetAllCustomersAction
{
    /**
     * @param array $conditions
     */
    public function handle(array $conditions = null)
    {
        $customers = Customer::MerchantCustomersIds()->where('type', 'customer');

        if ($conditions) {
            $customers->where($conditions);
        }

        return $customers;
    }
}
