<?php

namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductAttribute;
use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Entities\ProductVariantAttribute;
use Modules\Merchants\Http\Requests\ProductVariants\StoreProductVariantRequest;
use Modules\Merchants\Services\ProductVariantsService;


class StoreVariantsProductAction
{
    /**
     * @param StoreProductVariantRequest $request
     * @return ProductAttribute
     */
    public function handle(StoreProductVariantRequest $request)
    {
        $productVariantsService = new ProductVariantsService();
        $productVariant= ProductVariant::create($productVariantsService->prepareVariant($request));
        ProductVariantAttribute::insert($productVariantsService->prepareProductVariantsOptions($request, $productVariant->id));
    }

}
