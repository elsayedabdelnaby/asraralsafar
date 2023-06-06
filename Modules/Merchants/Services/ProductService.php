<?php

namespace Modules\Merchants\Services;

use App\Traits\FileUploadTrait;
use Modules\Merchants\Http\Requests\Product\StoreProductRequest;
use Modules\Merchants\Http\Requests\Product\UpdateMerchantProductRequest;


class ProductService
{
    use FileUploadTrait;

    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreProductRequest $request
     * @return array
     */
    public function prepareAttributes(StoreProductRequest|UpdateMerchantProductRequest $request): array
    {
        $storeAttrs = [
            'type'=> $request->get('type'),
            'merchant_id'=> $request->get('merchant_id'),
            'category_type_id' => $request->get('category_type_id'),
            'price'=> null,
            'discount_price'=> null,
            'accept_additions'=> $request->has('accept_additions') ? 1 : 0,
            'is_active'=> $request->has('is_active') ? 1 : 0,
        ];

        if ($request->file('image')) {
            $storeAttrs['image'] = $this->verifyAndUpload($request->file('image'), '', 'public', 'merchants/products');
        }

        if ($request->get('type') == 'simple'){
            $storeAttrs['price']= $request->get('price');
            $storeAttrs['discount_price']= $request->get('discount_price');
        }

        return $storeAttrs;
    }

    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreProductRequest $request
     * @return array
     */
    public function prepareTranslationsAttributes(StoreProductRequest|UpdateMerchantProductRequest $request, $product_id): array
    {
        $additions_product_translations = [];
        foreach ($request->get('translations') as $translations) {
            $additions_product_translations[] = [
                'product_id'       => $product_id,
                'language_id'      => $translations['language_id'],
                'name'             => $translations['name'],
                'slug'             => $translations['name'],
                'description'      => $translations['description'],
                'meta_title'       => $translations['name'],
                'meta_description' => $translations['description'],
                'created_at'       => now(),
                'updated_at'       => now()
            ];
        }

        return $additions_product_translations;
    }
}
