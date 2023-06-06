<?php

namespace Modules\Settings\Actions\Currencies;

use Modules\Settings\Entities\Currency;
use Modules\Settings\Services\CurrencyService;
use Modules\Settings\Http\Requests\Currency\UpdateCurrencyRequest;

/**
 * @purpose update the Currency
 */
class UpdateCurrencyAction
{
    /**
     * @param UpdateCurrencyRequest $request
     */
    public function handle(UpdateCurrencyRequest $request)
    {
        $currencyService = new CurrencyService();
        $currency        = Currency::find($request->get('id'));
        if ($currency->is_main) {
            $request->request->add([
                'is_main' => 'on'
            ]);
        }
        $currency->update($currencyService->prepareAttributes($request));
        if ($request->is_main) {
            $currencyService->changeToMainCurrency($request->get('id'));
        }
    }
}
