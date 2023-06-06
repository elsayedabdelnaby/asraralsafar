<?php

namespace Modules\Locations\Actions\City;

use Modules\Locations\Entities\City;
use Modules\Locations\Services\CityService;
use Modules\Locations\Entities\CityTranslation;
use Modules\Locations\Http\Requests\City\UpdateCityRequest;

class UpdateCityAction
{
    public function handle(UpdateCityRequest $request): City
    {
        //update city info
        $cityService = new CityService();
        $city = City::find($request->get("id"));
        $city->update($cityService->prepareAttributes($request));

        //update city translation
        $this->updateCityTranslations($request->get('translations'), $city);
        return $city;
    }

    /**
     * take the new translations array and update the city translations
     * and remove doen't exist in new translations array
     * @param array $translations
     * @param City $city
     * @return void
     */
    private function updateCityTranslations(array $translations, City $city): void
    {
        $languagesIds = [];
        foreach ($translations as $translation) {
            $languagesIds[] = $translation['language_id'];
            CityTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'city_id' => $city->id
                ],
                [
                    "name" => $translation["name"]
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($city->translations->pluck('language_id')->toArray(), $languagesIds, $city->id);
    }

    /**
     * Take the new translations languages ids and the current
     * and delete the doesn't exist translations in new array
     * @param array $currenLanguagesIds
     * @param array $newLanguagesIds
     * @param int $cityId
     *@return boolean
     */
    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $cityId): bool
    {
        //Delete Not Exist Country Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return CityTranslation::whereIn('language_id', $deletedLanguages)->where('city_id', $cityId)->delete();
    }
}
