<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Http\Requests\Coupon\StoreMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\UpdateMerchantCouponRequest;

class CouponService
{
    /**
     * Take a request and return the array of data to create|update a coupon
     * @param StoreMerchantCouponRequest|UpdateMerchantCouponRequest $request
     * @return array
     */
    public function prepareAttributes(StoreMerchantCouponRequest|UpdateMerchantCouponRequest $request): array
    {
        return [
            'code' => $request->get('code'),
            'value_type' => $request->get('value_type'),
            'value' => $request->get('value'),
            'merchant_id' => $request->get('merchant_id'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'limited_usage' => $request->get('limited_usage'),
            'user_max_usage' => $request->get('user_max_usage'),
            'min_order' => $request->get('min_order'),
            'max_order' => $request->get('max_order'),
            'min_shipping' => $request->get('min_shipping'),
            'max_shipping' => $request->get('max_shipping'),
            'one_time' => $request->get('one_time') !== null ? 1 : 0,
            'first_order' => $request->get('first_order') !== null ? 1 : 0,
            'is_active' => $request->get('is_active') !== null ? 1 : 0,
            'apply_on_cash' => $request->get('apply_on_cash') !== null ? 1 : 0,
            'apply_on_card' => $request->get('apply_on_card') !== null ? 1 : 0,
            'type' => $request->get('type') ?? "order",
            'status' => $request->get('status') ?? "pending",
        ];
    }

    /**
     * Take the translations array from the request and return the array to insert
     * @param array $translations
     * @param int $couponId
     * @return array
     */
    public function prepareTranslationDataToInsert(array $translations, int $couponId): array
    {
        $translation_data = [];

        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'coupon_id' => $couponId
            ];
        }
        return $translation_data;
    }
}
