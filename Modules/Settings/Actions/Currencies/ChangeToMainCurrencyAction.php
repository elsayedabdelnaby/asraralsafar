<?php

namespace Modules\Settings\Actions\Currencies;

use Modules\Settings\Services\CurrencyService;
use Modules\Settings\Http\Requests\Currency\ChangeToMainCurrencyRequest;

/**
 * @purpose delete a tag
 */
class ChangeToMainCurrencyAction
{
    /**
     * @param ChangeToMainCurrencyRequest $request
     */
    public function handle(ChangeToMainCurrencyRequest $request)
    {
        (new CurrencyService)->changeToMainCurrency($request->get('id'));
    }
}
