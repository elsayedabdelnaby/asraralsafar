<?php

namespace Modules\Locations\Actions\Countries;

use Modules\Locations\Entities\Country;

class GetAllCountries
{
    public function handle()
    {
        return Country::currentLanguageTranslation('countries', 'country_translations', 'country_id')
            ->join('currency_translations', 'countries.currency_id', '=', 'currency_translations.currency_id')
            ->where('currency_translations.language_id', getCurrentLanguage()->id);
    }
}
