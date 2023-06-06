<?php

namespace Modules\Locations\Services;

use Modules\Locations\Http\Requests\City\StoreCityRequest;
use Modules\Locations\Http\Requests\City\UpdateCityRequest;

class CityService
{
    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreCityRequest|UpdateCityRequest $request
     * @return array
     */
    public function prepareAttributes(StoreCityRequest|UpdateCityRequest $request): array
    {
        return [
            "state_id" => $request->get("state_id"),
            "is_active" => $request->get("is_active") ? 1 : 0,
        ];
    }

    /**
     * Take the translations array from the request and return the array to insert
     * @param array $translations
     * @param int $cityId
     * @return array
     */
    public function prepareTranslationDataToInsert(array $translations, int $cityId): array
    {
        $translation_data = [];
        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'city_id' => $cityId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $translation_data;
    }
}
