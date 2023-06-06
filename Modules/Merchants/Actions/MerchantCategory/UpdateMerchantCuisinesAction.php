<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantCuisine;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;

class UpdateMerchantCuisinesAction
{
    public function handle(UpdateMerchantRequest $request, $merchant)
    {
        MerchantCuisine::where('merchant_id',$merchant->id)->delete();
        foreach ($request->get('merchant_cuisines') as $item) {
            MerchantCuisine::create([
                'merchant_id'=>$merchant->id,
                'category_id'=>$item,
            ]);
        }
    }
}
