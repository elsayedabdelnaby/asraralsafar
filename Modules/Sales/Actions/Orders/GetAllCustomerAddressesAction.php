<?php

namespace Modules\Sales\Actions\Orders;

use App\Models\User;
use Modules\Sales\Entities\Customer;
use Modules\Sales\Entities\CustomerAddress;

class GetAllCustomerAddressesAction
{

    public function handle()
    {
        return CustomerAddress::get()
            ->map(function ($query) {
                return [
                    'id' => $query->id,
                    'address' => $query->address
                ];
            });
    }
}
