<?php

namespace Modules\Merchants\Actions\Coupon;

use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\CouponApplying;
use Modules\Merchants\Entities\CouponTranslation;
use Modules\Merchants\Http\Requests\Coupon\StoreMerchantCouponRequest;
use Modules\Merchants\Services\CouponApplyingService;
use Modules\Merchants\Services\CouponService;
use function PHPUnit\Framework\isNull;

class StoreMerchantCouponAction
{
    public function handle(StoreMerchantCouponRequest $request): Coupon
    {
        $service = new CouponService();

        // Create coupon basic data
        $coupon = Coupon::create($service->prepareAttributes($request));

        // Create coupon translation data
        CouponTranslation::insert($service->prepareTranslationDataToInsert($request->get('translations'), $coupon->id));


        $coupon_applying = (new CouponApplyingService())->prepareAttributes($request);

        // Create coupon applying data
        if ($coupon_applying)
            self::createCouponApplying($coupon_applying, $coupon);

        // Create coupon category
        $category_id = $request->get('category_id');
        if (!is_null($category_id))
            self::createCouponCategories($category_id, $coupon);

        return $coupon;
    }

    protected static function createCouponCategories(array $categories, Coupon $coupon): void
    {
        $coupon->categories()->sync($categories);
    }

    protected static function createCouponApplying(array $applying, Coupon $coupon): void
    {
        // Get the max biggest length of applying and use it as end of the loop
        array_multisort($applying, SORT_DESC);
        $max_len = count(current($applying));

        for ($i = 0; $i < $max_len; $i++)
            CouponApplying::create([
                'coupon_id' => $coupon->id,
                'city_id' => $applying['city_id'][$i] ?? null,
                'branch_id' => $applying['branch_id'][$i] ?? null,
            ]);
    }
}
