<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantMeal;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;

class UpdateMerchantMealsAction
{
    public function handle(UpdateMerchantRequest $request, $merchant)
    {
        MerchantMeal::where('merchant_id',$merchant->id)->delete();
        foreach ($request->get('merchant_meals') as $item) {
            MerchantMeal::create([
                'merchant_id'=>$merchant->id,
                'category_id'=>$item,
            ]);
        }
    }
}
