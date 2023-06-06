<?php

namespace Modules\Merchants\Actions\Coupon;

use App\Traits\FileUploadTrait;
use Modules\Merchants\Entities\Coupon;
use Modules\Merchants\Entities\CouponApplying;
use Modules\Merchants\Entities\CouponTranslation;
use Modules\Merchants\Entities\MerchantSocial;
use Modules\Merchants\Http\Requests\Coupon\StoreMerchantCouponRequest;
use Modules\Merchants\Http\Requests\Coupon\UpdateMerchantCouponRequest;
use Modules\Merchants\Services\CouponApplyingService;
use Modules\Merchants\Services\CouponService;
use Modules\Merchants\Services\SocialService;

class UpdateMerchantCouponAction
{
    public function handle(UpdateMerchantCouponRequest $request): Coupon
    {
        $service = new CouponService();

        $coupon = Coupon::whereId($request->id)
            ->first();

        // Update coupon basic data
        $coupon->update($service->prepareAttributes($request));

        // Update coupon translation data
        self::updateCouponTranslations($request->get('translations'), $coupon);

        // Update coupon category
        $coupon->categories()->sync($request->get('category_id'));

        // Update coupon applying data
        $coupon_applying = (new CouponApplyingService())->prepareAttributes($request);
        if ($coupon_applying)
            self::updateCouponApplying($coupon_applying, $coupon);

        return $coupon;
    }

    protected static function updateCouponTranslations(array $translations, Coupon $coupon): void
    {
        foreach ($translations as $translation) {
            $coupon_tr = CouponTranslation::where('coupon_id', $coupon->id)
                ->where('language_id', $translation['language_id'])
                ->first();

            if ($coupon_tr)
                $coupon->update(['name' => $translation['name']]);

            else
                CouponTranslation::create([
                    'coupon_id' => $coupon->id,
                    'name' => $translation['name'],
                    'language_id' => $translation['language_id'],
                ]);
        }
    }

    protected static function updateCouponApplying(array $applying, Coupon $coupon): void
    {
        if ($applying['city_id'])
            foreach ($applying['city_id'] as $city)
                CouponApplying::whereId($coupon->id)
                    ->updateOrCreate([
                        'city_id' => $city,
                        'coupon_id' => $coupon->id
                    ]);

        if ($applying['branch_id'])
            foreach ($applying['branch_id'] as $branch)
                CouponApplying::whereId($coupon->id)
                    ->updateOrCreate([
                        'branch_id' => $branch,
                        'coupon_id' => $coupon->id
                    ]);
    }
}
