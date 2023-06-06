<?php

namespace Modules\Settings\Observers;

use Modules\Settings\Entities\Currency;
use App\Services\Cache\ClearCachedAttributes;

class CurrencyObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Currency "updated" event.
     *
     * @param  \Modules\Categories\Entites\Currency  $currency
     * @return void
     */
    public function updated(Currency $currency)
    {
        ClearCachedAttributes::clear($currency->id, [
            'currency_name',
        ]);
    }

    /**
     * Handle the Currency "deleted" event.
     *
     * @param  \Modules\Categories\Entites\Currency  $currency
     * @return void
     */
    public function deleted(Currency $currency)
    {
        ClearCachedAttributes::clear($currency->id, [
            'currency_name',
        ]);
    }
}
