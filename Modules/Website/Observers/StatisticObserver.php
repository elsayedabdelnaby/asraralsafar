<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\Statistic;
use App\Services\Cache\ClearCachedAttributes;

class StatisticObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Statistic "updated" event.
     *
     * @param  \Modules\Website\Entites\Statistic  $faq
     * @return void
     */
    public function updated(Statistic $faq)
    {
        ClearCachedAttributes::clear($faq->id, ['statistic_title']);
    }

    /**
     * Handle the Statistic "deleted" event.
     *
     * @param  \Modules\Website\Entites\Statistic  $faq
     * @return void
     */
    public function deleted(Statistic $faq)
    {
        ClearCachedAttributes::clear($faq->id, ['statistic_title']);
    }
}
