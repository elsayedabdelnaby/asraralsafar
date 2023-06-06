<?php

namespace Modules\Locations\Actions\State;

use \Illuminate\Http\Request;
use Modules\Locations\Entities\State;

class FilterStatesActions
{
    public function handle(Request $request)
    {
        $states = State::join('country_translations', 'country_translations.country_id', '=', 'states.country_id')
            ->currentLanguageTranslation("states", 'state_translations', 'state_id')
            ->where('country_translations.language_id', getCurrentLanguage()->id);

        if ($request->request->get('country_id') || $request->get('country_id')) {
            $countryId = $request->request->get('country_id') ? $request->request->get('country_id') : $request->get('country_id');
            $states->where('states.country_id', $countryId);
        }

        if ($request->request->get('name')) {
            $name = $request->request->get('name');
            $states = $states->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });
        }
        return $states;
    }
}
