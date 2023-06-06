<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\TermCondition;
use App\Services\Cache\ClearCachedAttributes;

class TermConditionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the TermCondition "updated" event.
     *
     * @param  \Modules\Website\Entites\TermCondition  $term_condition
     * @return void
     */
    public function updated(TermCondition $term_condition)
    {
        ClearCachedAttributes::clear($term_condition->id, ['term_condition_title', 'term_condition_description']);
    }

    /**
     * Handle the TermCondition "deleted" event.
     *
     * @param  \Modules\Website\Entites\TermCondition  $term_condition
     * @return void
     */
    public function deleted(TermCondition $term_condition)
    {
        ClearCachedAttributes::clear($term_condition->id, ['term_condition_title', 'term_condition_description']);
    }
}
