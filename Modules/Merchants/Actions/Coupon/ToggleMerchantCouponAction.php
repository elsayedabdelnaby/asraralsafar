<?php

namespace Modules\Merchants\Actions\Coupon;

use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Http\Requests\Coupon\ToggleMerchantCouponRequest;

class ToggleMerchantCouponAction
{
    public function handle(ToggleMerchantCouponRequest $request)
    {
        $coupon = Coupon::find($request->id);
        $name = $request->name;
        $coupon->$name = !$coupon->$name;
        return $coupon->save();
    }
}
