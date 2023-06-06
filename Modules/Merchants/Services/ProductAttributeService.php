<?php

namespace Modules\Merchants\Services;

use Modules\Merchants\Http\Requests\ProductAttribtues\StoreProductAttributeRequest;
use Modules\Merchants\Http\Requests\ProductAttribtues\UpdateProductAttributeRequest;

class ProductAttributeService
{

    /**
     * Take a request and return the array of data to create|update a product attribute
     * @param StoreProductAttributeRequest|UpdateProductAttributeRequest $request
     * @return array
     */
    public function prepareAttributes(StoreProductAttributeRequest|UpdateProductAttributeRequest $request): array
    {
        $attributes = [
            "is_active" => $request->is_active ? 1 : 0,
            "input_type" => $request->type,
        ];

        return $attributes;
    }



    /**
     * Take the translations array from the request and return the array to insert
     * @param array $translations
     * @param int $cityId
     * @return array
     */
    public function prepareTranslationDataToInsert(array $translations, int $productAttributeId): array
    {
        $translation_data = [];
        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'product_attribute_id' => $productAttributeId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $translation_data;
    }
}
