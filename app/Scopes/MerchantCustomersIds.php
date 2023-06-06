<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Modules\Sales\Entities\Order;

trait MerchantCustomersIds
{
    public function scopeMerchantCustomersIds($query)
    {
        //Merchant Manager
        if (Auth::user()->role_id == 2){
            return $query->whereIn('id',Order::MerchantBranchesIds()->pluck('customer_id')->toArray());
        }

        //Branch Manager
        if (Auth::user()->role_id == 3){
            return $query->whereIn('id',Order::MerchantBranchesIds()->pluck('customer_id')->toArray());
        }

        return $query;
    }
}
