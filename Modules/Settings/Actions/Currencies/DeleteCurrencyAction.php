<?php

namespace Modules\Settings\Actions\Currencies;

use Modules\Settings\Entities\Currency;
use Modules\Settings\Http\Requests\Currency\DeleteCurrencyRequest;

/**
 * @purpose delete a Currency
 */
class DeleteCurrencyAction
{
    /**
     * @param DeleteCurrencyRequest $request
     * @return bool
     */
    public function handle(DeleteCurrencyRequest $request): bool
    {
        $currency = Currency::find($request->id);
        return $currency->delete();
    }
}
