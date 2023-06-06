<?php

namespace Modules\Merchants\Actions\Coupon;

use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Http\Requests\Coupon\EditMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\IndexMerchantCouponRequest;

class FilterMerchantCouponAction
{
    public function handle(IndexMerchantCouponRequest|EditMerchantCouponRequest $request)
    {

        $coupon = Coupon::currentLanguageTranslation('coupons', 'coupon_translations', 'coupon_id');

        if ($request->request->get('name')) {
            $name = $request->request->get('name');
            $coupon->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        return $coupon;
    }
}
