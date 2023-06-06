<?php

namespace Modules\Settings\Actions\Currencies;

use Modules\Settings\Entities\Currency;

/**
 * @purpose get all Currencies
 */
class GetAllCurrencies
{
    public function handle()
    {
        return Currency::currentLanguageTranslation('currencies', 'currency_translations', 'currency_id');
    }
}
