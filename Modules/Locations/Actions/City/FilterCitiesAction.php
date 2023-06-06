<?php

namespace Modules\Locations\Actions\City;

use \Illuminate\Http\Request;
use Modules\Locations\Entities\City;

class FilterCitiesAction
{
    public function handle(Request $request)
    {
        $cities = City::join('state_translations', 'state_translations.state_id', 'cities.state_id')
            ->currentLanguageTranslation("cities", 'city_translations', 'city_id')
            ->where('state_translations.language_id', getCurrentLanguage()->id);

        if ($request->request->get('country_id') || $request->get('country_id')) {
            $countryId = $request->request->get('country_id') ? $request->request->get('country_id') : $request->get('country_id');
            $cities->join('states', 'states.id', 'cities.state_id')
                ->where('states.country_id', $countryId);
        }

        if ($request->request->get('state_id') || $request->get('state_id')) {
            $stateId = $request->request->get('state_id') ? $request->request->get('state_id') : $request->get('state_id');
            $cities->where('cities.state_id', $stateId);
        }

        if ($request->request->get('name')) {
            $name = $request->request->get('name');
            $cities = $cities->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });
        }

        return $cities;
    }
}
