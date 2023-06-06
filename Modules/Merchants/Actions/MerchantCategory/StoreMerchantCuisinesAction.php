<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantCuisine;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;

class StoreMerchantCuisinesAction
{
    public function handle(StoreMerchantRequest $request, $merchant_id)
    {
        foreach ($request->get('merchant_cuisines') as $item) {
            MerchantCuisine::create([
                'merchant_id'=>$merchant_id,
                'category_id'=>$item,
            ]);
        }
    }
}
