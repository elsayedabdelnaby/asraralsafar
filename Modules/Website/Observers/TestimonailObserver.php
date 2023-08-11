<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\Testimonail;
use App\Services\Cache\ClearCachedAttributes;

class TestimonailObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Testimonail "updated" event.
     *
     * @param  \Modules\Website\Entites\Testimonail  $testimonail
     * @return void
     */
    public function updated(Testimonail $testimonail)
    {
        ClearCachedAttributes::clear($testimonail->id, ['testimonail_client_name', 'testimonail_testimonail']);
    }

    /**
     * Handle the Testimonail "deleted" event.
     *
     * @param  \Modules\Website\Entites\Testimonail  $testimonail
     * @return void
     */
    public function deleted(Testimonail $testimonail)
    {
        ClearCachedAttributes::clear($testimonail->id, ['testimonail_client_name', 'testimonail_testimonail']);
    }
}
