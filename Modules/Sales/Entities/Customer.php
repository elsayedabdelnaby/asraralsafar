<?php

namespace Modules\Sales\Entities;

use App\Models\User;
use App\Scopes\MerchantCustomersIds;


class Customer extends User
{
    use MerchantCustomersIds;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "users";

    /**
     * get all related addresses
     */
    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }
}
