<?php

namespace Modules\Locations\Actions\Countries;

use Illuminate\Http\Request;
use Modules\Locations\Entities\Country;

class FilterCountryActions
{
    public function handle(Request $request)
    {
        $countries = Country::Join('currency_translations', 'countries.currency_id', '=', 'currency_translations.currency_id')->currentLanguageTranslation("countries", 'country_translations', 'country_id');
        if ($request->request->get('name')) {
            $name      = $request->request->get('name');
            $countries = $countries->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });
        }
        return $countries;
    }
}
