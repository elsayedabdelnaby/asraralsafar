<?php

namespace Modules\Locations\Services;

use Modules\Locations\Http\Requests\State\StoreStateRequest;
use Modules\Locations\Http\Requests\State\UpdateStateRequest;

class StateService
{
    /**
     * Take a request and return the array of data to create|update a state
     * @param StoreStateRequest|UpdateStateRequest $request
     * @return array
     */
    public function prepareAttributes(StoreStateRequest|UpdateStateRequest $request): array
    {
        return [
            "country_id" => $request->get("country_id"),
            "is_active" => $request->get("is_active") ? 1 : 0,
        ];
    }

    /**
     * Take the translations array from the request and return the array to insert
     * @param array $translations
     * @param int $stateId
     * @return array
     */
    public function prepareTranslationDataToInsert(array $translations, int $stateId): array
    {
        $translation_data = [];
        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'state_id' => $stateId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $translation_data;
    }
}
