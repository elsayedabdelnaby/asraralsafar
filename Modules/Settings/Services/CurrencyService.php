<?php

namespace Modules\Settings\Services;

use Illuminate\Http\Request;
use Modules\Settings\Entities\Currency;
use Modules\Settings\Entities\CurrencyTranslation;

class CurrencyService
{
    /**
     * change the main currency to this currency
     * @param int $currency_id
     * @return boolean
     */
    public function changeToMainCurrency(int $currency_id): bool
    {
        Currency::where('is_main', 1)->update(['is_main' => 0]);
        return Currency::where('id', $currency_id)->update(['is_main' => 1]);
    }

    /**
     * take store/update currency request and prepare data for currency updating/creation
     * @param Request $request
     * @return array
     */
    public function prepareAttributes(Request $request): array
    {
        return [
            'iso_code' => $request->get('iso_code'),
            'symbol' => $request->get('symbol'),
            'html_entity' => $request->get('html_entity'),
            'is_main' => $request->is_main ? true : false,
            'is_active' => $request->is_active ? true : false,
            'is_symbol_first' => $request->is_symbol_first ? true : false
        ];
    }

    /**
     * return the main currency
     */
    public function getMainCurrency()
    {
        return Currency::where('is_main', true)->first();
    }

    /**
     * save the translations of the currency
     * @param array $translations
     * @param int $currencyId
     */

    public function saveTranslations(array $translations, int $currencyId): bool
    {
        $translation_data = [];
        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'currency_id' => $currencyId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        return CurrencyTranslation::insert($translation_data);
    }
}
