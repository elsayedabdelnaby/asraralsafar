<?php

namespace Modules\Locations\Actions\Countries;

use Modules\Locations\Entities\Country;
use Modules\Locations\Services\CountryService;
use Modules\Locations\Entities\CountryTranslation;
use Modules\Locations\Http\Requests\Country\StoreCountryRequest;

class StoreCountryAction
{
    /**
     * @param array $data
     * @return Country
     */
    public function handle(StoreCountryRequest $request): Country
    {
        $countryService = new CountryService();
        $country = Country::create($countryService->prepareAttributes($request));
        CountryTranslation::insert($countryService->prepareTranslationDataToInsert($request->get('translations'), $country->id));
        return $country;
    }
}
