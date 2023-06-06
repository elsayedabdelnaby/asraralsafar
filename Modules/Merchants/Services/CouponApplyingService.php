<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Http\Requests\Coupon\StoreMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\UpdateMerchantCouponRequest;

class CouponApplyingService
{
    /**
     * Take a request and return the array of data to create|update a coupon
     * @param StoreMerchantCouponRequest|UpdateMerchantCouponRequest $request
     * @return array|bool
     */
    public function prepareAttributes(StoreMerchantCouponRequest|UpdateMerchantCouponRequest $request): array|bool
    {
        $city_id = $request->get('city_id');
        $branch_id = $request->get('branch_id');

        if (is_null($city_id) && is_null($branch_id))
            return false;

        return [
            'city_id' => $request->get('city_id'),
            'branch_id' => $request->get('branch_id'),
        ];
    }
}
