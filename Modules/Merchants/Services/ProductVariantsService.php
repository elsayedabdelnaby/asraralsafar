<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Http\Requests\ProductVariants\StoreProductVariantRequest;
use Modules\Merchants\Http\Requests\ProductVariants\UpdateMerchantProductVariantRequest;

class ProductVariantsService
{

    /**
     * Take a request and return the array of data to create|update a product attribute
     * @param StoreProductVariantRequest|UpdateMerchantProductVariantRequest $request
     * @return array
     */
    public function prepareVariant(StoreProductVariantRequest|UpdateMerchantProductVariantRequest $request): array
    {
        $attributes = [
            'product_id'=>$request->get('product_id'),
            'is_active'=>$request->has('is_active')? 1 :0,
            'price'=>$request->get('price')
        ];

        return $attributes;
    }



    /**
     * Take the translations array from the request and return the array to insert
     * @param StoreProductVariantRequest|UpdateMerchantProductVariantRequest $request
     * @param int $productAttributeId
     * @return array
     */
    public function prepareProductVariantsOptions(StoreProductVariantRequest|UpdateMerchantProductVariantRequest $request, int $productVariantId): array
    {
        $product_variants_options = [];
        foreach ($request->get('variants') as $option) {
            $product_variants_options[] = [
                'product_variant_id'=>$productVariantId,
                'product_attribute_id'=>$option['product_attribute'],
                'product_attribute_option_id'=>$option['attribute_type_selected'] == 'select' ? $option['product_attribute_option'] : null ,
                'value'=>$option['value'],
                'created_at'=>now(),
                'updated_at'=>now()
            ];
        }
        return $product_variants_options;
    }
}
