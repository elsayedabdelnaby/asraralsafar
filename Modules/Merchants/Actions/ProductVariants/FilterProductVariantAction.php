<?php

namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Http\Requests\ProductVariants\ListingProductVariantsRequest;

class FilterProductVariantAction
{
    public function handle(ListingProductVariantsRequest $request)
    {
        return ProductVariant::where('product_id',$request->get('product_id'));
    }
}
