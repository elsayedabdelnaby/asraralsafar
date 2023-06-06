<?php

namespace Modules\Settings\Actions\Currencies;

use Modules\Settings\Entities\Currency;
use Modules\Settings\Services\CurrencyService;
use Modules\Settings\Http\Requests\Currency\StoreCurrencyRequest;

/**
 * handle creation of Currency
 */
class StoreCurrencyAction
{
    /**
     * @param StoreCurrencyRequest $request
     */
    public function handle(StoreCurrencyRequest $request): Currency
    {
        $currencyService = new CurrencyService();
        $currency = Currency::create($currencyService->prepareAttributes($request));

        if ($request->is_main) {
            $currencyService->changeToMainCurrency($currency->id);
        }

        $currencyService->saveTranslations($request->get('translations'), $currency->id);

        return $currency;
    }
}
