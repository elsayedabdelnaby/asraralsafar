<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantWorkingTypes;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;

class StoreMerchantTypesAction
{
    public function handle(StoreMerchantRequest $request, $merchant_id)
    {
        foreach ($request->get('merchant_types') as $item) {
            MerchantWorkingTypes::create([
                'merchant_id'=>$merchant_id,
                'category_id'=>$item,
            ]);
        }
    }
}
