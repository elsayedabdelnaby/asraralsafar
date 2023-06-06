<?php

namespace Modules\Locations\Actions\City;

use Modules\Locations\Entities\City;
use Modules\Locations\Services\CityService;
use Modules\Locations\Entities\CityTranslation;
use Modules\Locations\Http\Requests\City\StoreCityRequest;

class StoreCityAction
{
    /**
     * create a new city
     * @param StoreCityRequest $request
     * @return City
     */
    public function handle(StoreCityRequest $request): City
    {
        $cityService = new CityService();
        $city = City::create($cityService->prepareAttributes($request));
        CityTranslation::insert($cityService->prepareTranslationDataToInsert($request->get('translations'), $city->id));
        return $city;
    }
}
