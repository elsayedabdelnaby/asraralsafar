<?php

namespace Modules\Settings\Actions\Currencies;


use Modules\Settings\Entities\Currency;
use Modules\Settings\Http\Requests\Currency\ToggleCurrencyRequest;

/**
 * @purpose toggle the Currency status
 */
class ToggleCurrencyAction
{
    /**
     * @param ToggleCurrencyRequest $request
     * return boolean
     */
    public function handle(ToggleCurrencyRequest $request): bool
    {
        $currency = Currency::find($request->id);
        $toggleFiledName = $request->name;

        if ($toggleFiledName == 'is_active' || $toggleFiledName == 'is_symbol_first') {
            $currency->$toggleFiledName = !$currency->$toggleFiledName;
        }

        return $currency->save();
    }
}
