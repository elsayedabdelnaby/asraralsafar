<?php

namespace Modules\Sales\Actions\Orders;

use Illuminate\Support\Collection;
use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Http\Requests\Coupon\EditMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\IndexMerchantCouponRequest;

class GetAllBranchesAction
{
    /**
     * @return Collection
     */
    public function handle($merchantId): Collection
    {
        return MerchantBranch::with('translations')
            ->where('merchant_id', $merchantId)
            ->get()
            ->map(function ($query) {
                return [
                    'id' => $query->id,
                    'name' => $query->translations->first()->name
                ];
            });
    }
}
