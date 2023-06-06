<?php

namespace Modules\Merchants\Actions\Merchant;

use App\Console\Commands\RedisSubscribe;
use App\Traits\FileUploadTrait;
use Modules\Merchants\Actions\MerchantCategory\UpdateMerchantCategoryItemsAction;
use Modules\Merchants\Actions\MerchantCategory\UpdateMerchantCuisinesAction;
use Modules\Merchants\Actions\MerchantCategory\UpdateMerchantMealsAction;
use Modules\Merchants\Actions\MerchantCategory\UpdateMerchantTypesAction;
use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Entities\MerchantTranslation;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;
use Modules\Merchants\Services\MerchantService;

class UpdateMerchantAction
{
    use FileUploadTrait;

    public function handle(UpdateMerchantRequest $request)
    {

        $merchantService = new MerchantService();
        //update Merchant Info
        $merchant = Merchant::find($request->get("id"));

        $merchant->update($merchantService->prepareAttributes($request));

        //Update Country Translation
        $this->updateMerchantTranslations($request->get('merchant_translations'), $merchant);

        //Update Merchant Category Items Action
        (new UpdateMerchantCategoryItemsAction())->handle($request,$merchant);

        //Update Merchant Category Cuisines Action
        (new UpdateMerchantCuisinesAction())->handle($request,$merchant);

        //Update  Merchant Types
        (new UpdateMerchantTypesAction())->handle($request,$merchant);

        //Update Merchant  Meals
        (new UpdateMerchantMealsAction())->handle($request,$merchant);

        $attrs = collect($merchant)->toArray();
        $attrs['notification_type']="merchant_update_info";
        (new RedisSubscribe())->publisherToPublicChannel($attrs);

        return $merchant;
    }


    /**
     * take the new translations array and update the city translations
     * and remove doesn't exist in new translations array
     * @param array $translations
     * @param Merchant $merchant
     * @return void
     */
    private function updateMerchantTranslations(array $translations, Merchant $merchant): void
    {
        $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            MerchantTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'merchant_id' => $merchant->id
                ],
                [
                    "name" => $translation["merchant_name"]
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($merchant->translations->pluck('language_id')->toArray(), $languagesIds, $merchant->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $cityId
     * @return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $merchantId): bool
    {
        //Delete Not Exist Merchant Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return MerchantTranslation::whereIn('language_id', $deletedLanguages)->where('merchant_id', $merchantId)->delete();
    }
}
