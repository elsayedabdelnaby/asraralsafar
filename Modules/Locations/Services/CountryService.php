<?php

namespace Modules\Locations\Services;

use Modules\Locations\Http\Requests\Country\StoreCountryRequest;
use Modules\Locations\Http\Requests\Country\UpdateCountryRequest;

class CountryService
{
    /**
     * Take a request and return the array of data to create|update a country
     * @param StoreCountryRequest|UpdateCountryRequest $request
     * @return array
     */
    public function prepareAttributes(StoreCountryRequest|UpdateCountryRequest $request): array
    {
        return [
            "phone_code" => $request->code,
            "currency_id" => $request->currency_id,
            "is_active" => $request->is_active ? 1 : 0,
        ];
    }

    /**
     * Take the translations array from the request and return the array to insert
     * @param array $translations
     * @param int $countryId
     * @return array
     */
    public function prepareTranslationDataToInsert(array $translations, int $countryId): array
    {
        $translation_data = [];
        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['name'],
                'nationality' => $translation['nationality'],
                'language_id' => $translation['language_id'],
                'country_id' => $countryId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $translation_data;
    }
}
