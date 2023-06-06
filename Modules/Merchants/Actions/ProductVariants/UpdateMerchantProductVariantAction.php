<?php

namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Entities\ProductVariantAttribute;
use Modules\Merchants\Http\Requests\ProductVariants\UpdateMerchantProductVariantRequest;
use Modules\Merchants\Services\ProductVariantsService;

class UpdateMerchantProductVariantAction
{
    public function handle(UpdateMerchantProductVariantRequest $request)
    {
        //Update Product Variant Info
        $productVariantService = new ProductVariantsService();
        $productVariant        = ProductVariant::find($request->get('id'));
        $productVariant->update($productVariantService->prepareVariant($request));

        //Update Product Variant Attribute
        $productVariant->attributes()->delete();
        ProductVariantAttribute::insert($productVariantService->prepareProductVariantsOptions($request, $productVariant->id));
    }
}
