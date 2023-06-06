<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;

trait MerchantId
{
    public function scopeMerchantId($query)
    {
        if (Auth::user()->role_id == 2){
            return $query->where('merchant_id',Auth::user()->merchant->id);
        }
    }
}
