<?php

namespace Modules\Merchants\Actions\Coupon;

use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\CouponApplying;
use Modules\Merchants\Entities\CouponTranslation;
use Modules\Merchants\Http\Requests\Coupon\DeleteMerchantCouponRequest;

class DeleteMerchantCouponAction
{
    public function handle(DeleteMerchantCouponRequest $request): void
    {
        $coupon = Coupon::whereId($request->id)
            ->first();

        // Delete coupon basic data
        $coupon->delete();

        // Delete coupon translation data
        CouponTranslation::where('coupon_id', $coupon->id)
            ->delete();

        // Delete coupon category
        $coupon->categories()->delete();

        // Delete coupon applying data
        CouponApplying::where('coupon_id', $coupon->id)
            ->delete();
    }
}
