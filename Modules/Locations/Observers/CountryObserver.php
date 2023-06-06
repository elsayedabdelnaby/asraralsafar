<?php

namespace Modules\Locations\Observers;

use Modules\Locations\Entities\Country;
use App\Services\Cache\ClearCachedAttributes;

class CountryObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the country "updated" event.
     *
     * @param  \Modules\Locations\Entites\Country  $country
     * @return void
     */
    public function updated(Country $country)
    {
        ClearCachedAttributes::clear($country->id, [
            'country_name',
        ]);
    }

    /**
     * Handle the country "deleted" event.
     *
     * @param  \Modules\Locations\Entites\Country  $country
     * @return void
     */
    public function deleted(Country $country)
    {
        ClearCachedAttributes::clear($country->id, [
            'country_name',
        ]);
    }
}
