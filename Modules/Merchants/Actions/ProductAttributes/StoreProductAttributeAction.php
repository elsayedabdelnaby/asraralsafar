<?php

namespace Modules\Merchants\Actions\ProductAttributes;

use Modules\Merchants\Entities\ProductAttribute;
use Modules\Merchants\Entities\ProductAttributeOption;
use Modules\Merchants\Services\ProductAttributeService;
use Modules\Merchants\Entities\ProductAttributeTranslation;
use Modules\Merchants\Entities\ProductAttributeOptionTranslation;
use Modules\Merchants\Http\Requests\ProductAttribtues\StoreProductAttributeRequest;

/**
 * @purpose
 * Create a new product attribute
 */
class StoreProductAttributeAction
{
    /**
     * @param StoreProductAttributeRequest $request
     * @return ProductAttribute
     */
    public function handle(StoreProductAttributeRequest $request): ProductAttribute
    {
        $productAttributeService = new ProductAttributeService();
        $productAttribute = ProductAttribute::create($productAttributeService->prepareAttributes($request));
        $productAttribute->categories()->sync($request->get('categories_ids'));
        ProductAttributeTranslation::insert($productAttributeService->prepareTranslationDataToInsert($request->get('translations'), $productAttribute->id));
        if ($request->type == 'Select') {
            $options = $request->get('attribute-options');
            $this->saveAttributeOptions($productAttribute->id, $options);
        }
        return new ProductAttribute();
    }

    /**
     * save attribute options
     */
    private function saveAttributeOptions(int $attributeId, array $options)
    {
        foreach ($options as $option) {

            $productAttributeOption = ProductAttributeOption::create([
                'is_active' => array_key_exists('option_is_active',$option) ? 1 : 0,
                'product_attribute_id' => $attributeId,
            ]);

            $this->saveAttributeOptionTranslations($option['attribute-option-translations'], $productAttributeOption->id);
        }
    }

    /**
     * save the product attribute option translations
     * @param array $optionTranslations
     * @param int $attributeOptionId
     */
    private function saveAttributeOptionTranslations(array $optionTranslations, int $attributeOptionId)
    {
        $translations = [];
        foreach ($optionTranslations as $translation) {
            $translations[] = [
                'language_id' => $translation['language_id'],
                'product_attribute_option_id' => $attributeOptionId,
                'name' => $translation['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        ProductAttributeOptionTranslation::insert($translations);
    }
}
