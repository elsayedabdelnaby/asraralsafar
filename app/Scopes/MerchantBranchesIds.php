<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;

trait MerchantBranchesIds
{
    public function scopeMerchantBranchesIds($query)
    {
        //Merchant Manager
        if (Auth::user()->role_id == 2){
            return $query->whereIn('merchant_branch_id',Auth::user()->merchant->branches->pluck('id')->toArray());
        }

        //Branch Manager
        if (Auth::user()->role_id == 3){
            return $query->where('merchant_branch_id',Auth::user()->branch->id);
        }

        return $query;
    }
}
