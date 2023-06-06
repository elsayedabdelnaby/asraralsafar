<?php

namespace Modules\Locations\Observers;

use Modules\Locations\Entities\State;
use App\Services\Cache\ClearCachedAttributes;

class StateObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the State "updated" event.
     *
     * @param  \Modules\Locations\Entites\State  $state
     * @return void
     */
    public function updated(State $state)
    {
        ClearCachedAttributes::clear($state->id, [
            'state_name',
        ]);
    }

    /**
     * Handle the State "deleted" event.
     *
     * @param  \Modules\Locations\Entites\State  $state
     * @return void
     */
    public function deleted(State $state)
    {
        ClearCachedAttributes::clear($state->id, [
            'state_name',
        ]);
    }
}
