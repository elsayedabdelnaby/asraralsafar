<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantWorkingTypes;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;

class UpdateMerchantTypesAction
{
    public function handle(UpdateMerchantRequest $request, $merchant)
    {
        MerchantWorkingTypes::where('merchant_id',$merchant->id)->delete();
        foreach ($request->get('merchant_types') as $item) {
            MerchantWorkingTypes::create([
                'merchant_id'=>$merchant->id,
                'category_id'=>$item,
            ]);
        }
    }
}
