<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantMeal;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;

class StoreMerchantMealsAction
{
    public function handle(StoreMerchantRequest $request, $merchant_id)
    {
        foreach ($request->get('merchant_meals') as $item) {
            MerchantMeal::create([
                'merchant_id'=>$merchant_id,
                'category_id'=>$item,
            ]);
        }
    }
}
