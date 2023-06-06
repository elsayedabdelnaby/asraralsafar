<?php

namespace Modules\Locations\Observers;

use Modules\Locations\Entities\City;
use App\Services\Cache\ClearCachedAttributes;

class CityObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the City "updated" event.
     *
     * @param  \Modules\Locations\Entites\City  $city
     * @return void
     */
    public function updated(City $city)
    {
        ClearCachedAttributes::clear($city->id, [
            'city_name',
        ]);
    }

    /**
     * Handle the City "deleted" event.
     *
     * @param  \Modules\Locations\Entites\City  $city
     * @return void
     */
    public function deleted(City $city)
    {
        ClearCachedAttributes::clear($city->id, [
            'city_name',
        ]);
    }
}
