<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;
use Modules\Merchants\Entities\ProductTranslation;
use Modules\Merchants\Http\Requests\Product\UpdateMerchantProductRequest;
use Modules\Merchants\Services\ProductService;

class UpdateMerchantProductAction
{
    public function handle(UpdateMerchantProductRequest $request)
    {
        $product = Product::find($request->get('id'));
        $product->update((new ProductService())->prepareAttributes($request));
        $product->categories()->sync($request->get('category_id'));
        $this->updateAdditionProductTranslations($request->get('translations'), $product);
        return $product;
    }


    /**
     * take the new translations array and update the country translations
     * and remove doen't exist in new translations array
     * @param array $translations
     * @param Product $country
     * @return void
     */
    private function updateAdditionProductTranslations(array $translations, Product $product): void
    {
        $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            ProductTranslation::updateOrCreate(
                [
                    'language_id'=> $translation['language_id'],
                    'product_id' => $product->id
                ],
                [
                    "name" => $translation["name"]
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($product->translations->pluck('language_id')->toArray(), $languagesIds, $product->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $productId
     * @return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $productId): bool
    {
        //Delete Not Exist  Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return ProductTranslation::whereIn('language_id', $deletedLanguages)->where('product_id', $productId)->delete();
    }

}
