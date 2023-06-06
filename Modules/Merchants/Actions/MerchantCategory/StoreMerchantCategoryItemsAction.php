<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantCategoryItem;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;

class StoreMerchantCategoryItemsAction
{
    public function handle(StoreMerchantRequest $request, $merchant_id)
    {
        foreach ($request->get('merchant_category_items') as $item) {
            MerchantCategoryItem::create([
                'merchant_id'=>$merchant_id,
                'category_id'=>$item,
            ]);
        }
    }
}
