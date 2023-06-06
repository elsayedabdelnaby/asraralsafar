<?php

namespace Modules\Merchants\Actions\AdditionsProduct;

use Modules\Merchants\Entities\AdditionProduct;
use Modules\Merchants\Entities\AdditionProductTranslation;
use Modules\Merchants\Http\Requests\AdditionsProducts\UpdateMerchantAdditionProductRequest;
use Modules\Merchants\Services\AdditionsProductService;

class UpdateMerchantAdditionProductAction
{
    public function handle(UpdateMerchantAdditionProductRequest $request)
    {
        $addition_product = AdditionProduct::find($request->get('id'));
        $addition_product->update((new AdditionsProductService())->prepareAttributes($request));

        $this->updateAdditionProductTranslations($request->get('translations'), $addition_product);
        return $addition_product;

    }


    /**
     * take the new translations array and update the country translations
     * and remove doen't exist in new translations array
     * @param array $translations
     * @param AdditionProduct $country
     * @return void
     */
    private function updateAdditionProductTranslations(array $translations, AdditionProduct $addition_product): void
    {
        $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            AdditionProductTranslation::updateOrCreate(
                [
                    'language_id'         => $translation['language_id'],
                    'addition_product_id' => $addition_product->id
                ],
                [
                    "name" => $translation["name"]
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($addition_product->translations->pluck('language_id')->toArray(), $languagesIds, $addition_product->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $additionProductId
     * @return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $additionProductId): bool
    {
        //Delete Not Exist  Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return AdditionProductTranslation::whereIn('language_id', $deletedLanguages)->where('addition_product_id', $additionProductId)->delete();
    }

}
