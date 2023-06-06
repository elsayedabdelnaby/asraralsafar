<?php

namespace Modules\Locations\Actions\Countries;

use Modules\Locations\Entities\Country;
use Modules\Locations\Services\CountryService;
use Modules\Locations\Entities\CountryTranslation;
use Modules\Locations\Http\Requests\Country\UpdateCountryRequest;

class UpdateCountryAction
{
    public function handle(UpdateCountryRequest $request): Country
    {
        //update Country Info
        $countryService = new CountryService();
        $country = Country::find($request->get("id"));
        $country->update($countryService->prepareAttributes($request));
        //Update Country Translation
        $this->updateCountryTranslations($request->get('translations'), $country);
        return $country;
    }

    /**
     * take the new translations array and update the country translations
     * and remove doen't exist in new translations array
     * @param array $translations
     * @param Country $country
     * @return void
     */
    private function updateCountryTranslations(array $translations, Country $country): void
    {
        $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            CountryTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'country_id' => $country->id
                ],
                [
                    'nationality' => $translation["nationality"],
                    "name" => $translation["name"]
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($country->translations->pluck('language_id')->toArray(), $languagesIds, $country->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $countryId
     *@return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $countryId): bool
    {
        //Delete Not Exist Country Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return CountryTranslation::whereIn('language_id', $deletedLanguages)->where('country_id', $countryId)->delete();
    }
}
