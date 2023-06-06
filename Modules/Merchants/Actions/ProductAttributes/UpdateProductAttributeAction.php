<?php

namespace Modules\Merchants\Actions\ProductAttributes;

use Modules\Merchants\Entities\ProductAttribute;
use Modules\Merchants\Entities\ProductAttributeOption;
use Modules\Merchants\Http\Requests\ProductAttribtues\UpdateProductAttributeRequest;
use Modules\Merchants\Services\ProductAttributeService;
use Modules\Merchants\Entities\ProductAttributeTranslation;
use Modules\Merchants\Entities\ProductAttributeOptionTranslation;

/**
 * @purpose
 * Create a new product attribute
 */
class UpdateProductAttributeAction
{
    /**
     * @param UpdateProductAttributeRequest $request
     * @return ProductAttribute
     */
    public function handle(UpdateProductAttributeRequest $request)
    {
        $productAttributeService = new ProductAttributeService();
        $productAttribute        = ProductAttribute::find($request->get('id'));
        $productAttribute->update($productAttributeService->prepareAttributes($request));
        $productAttribute->categories()->sync($request->get('categories_ids'));
        $this->UpdateProductAttributeTranslations($request->get('translations'), $productAttribute);
        if ($request->type == 'Select') {
            $this->saveAttributeOptions($productAttribute->id, $request->get('attribute-options'));
        }
    }

    /**
     * save attribute options
     */
    private function saveAttributeOptions(int $attributeId, array $options)
    {
        foreach ($options as $option) {
            $productAttributeOption = ProductAttributeOption::updateOrCreate(
                [
                    'id'=>$option['attribute_option_id'],
                ],
                [
                    'is_active'            => array_key_exists('option_is_active',$option) ? 1 : 0,
                    'product_attribute_id' => $attributeId,
                ]
            );
            $this->saveAttributeOptionTranslations($option['attribute-option-translations'], $productAttributeOption);
        }
    }

    /**
     * save the product attribute option translations
     * @param array $optionTranslations
     * @param ProductAttributeOption $attributeOption
     */
    private function saveAttributeOptionTranslations(array $optionTranslations,ProductAttributeOption  $attributeOption)
    {
        $languagesIds = [];
        foreach ($optionTranslations as $translation) {
           $languagesIds[] = $translation['language_id'];
           ProductAttributeOptionTranslation::updateOrCreate(
               [
                    'language_id'=> $translation['language_id'],
                    'product_attribute_option_id' => $attributeOption->id,
               ],
               [
                    'name'=> $translation['name'],
                    'created_at'=> now(),
                    'updated_at'=> now(),
               ]
           );
        }
        $this->deleteDonotExistTranslationsOptionsInNew($attributeOption->translations->pluck('language_id')->toArray(), $languagesIds, $attributeOption->id);
    }

    /**
     * take the new translations array and update the country translations
     * and remove doen't exist in new translations array
     * @param array $translations
     * @param ProductAttribute $productAttribute
     * @return void
     */
    private function UpdateProductAttributeTranslations(array $translations, ProductAttribute $productAttribute): void
    {
         $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            ProductAttributeTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'product_attribute_id'  => $productAttribute->id
                ],
                [
                    "name"=> $translation["name"],
                    'language_id'=> $translation['language_id'],
                    'product_attribute_id' => $productAttribute->id
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($productAttribute->translations->pluck('language_id')->toArray(), $languagesIds, $productAttribute->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $productAttributeId
     * @return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $productAttributeId): bool
    {
        //Delete Not Exist Country Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return ProductAttributeTranslation::whereIn('language_id', $deletedLanguages)->where('product_attribute_id', $productAttributeId)->delete();
    }



    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $productAttributeOptionId
     * @return boolean
     */
    private function deleteDonotExistTranslationsOptionsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $productAttributeOptionId): bool
    {
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return ProductAttributeOptionTranslation::whereIn('language_id', $deletedLanguages)->where('product_attribute_option_id', $productAttributeOptionId)->delete();
    }


}
