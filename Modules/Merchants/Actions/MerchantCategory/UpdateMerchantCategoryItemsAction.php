<?php

namespace Modules\Merchants\Actions\MerchantCategory;

use Modules\Merchants\Entities\MerchantCategoryItem;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;

class UpdateMerchantCategoryItemsAction
{
    public function handle(UpdateMerchantRequest $request, $merchant)
    {
        MerchantCategoryItem::where('merchant_id', $merchant->id)->delete();
        foreach ($request->get('merchant_category_items') as $item) {
            MerchantCategoryItem::create([
                'merchant_id' => $merchant->id,
                'category_id' => $item,
            ]);
        }
    }
}
