<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\FAQ;
use App\Services\Cache\ClearCachedAttributes;

class FAQObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the FAQ "updated" event.
     *
     * @param  \Modules\Website\Entites\FAQ  $faq
     * @return void
     */
    public function updated(FAQ $faq)
    {
        ClearCachedAttributes::clear($faq->id, ['faq_question', 'faq_answer']);
    }

    /**
     * Handle the FAQ "deleted" event.
     *
     * @param  \Modules\Website\Entites\FAQ  $faq
     * @return void
     */
    public function deleted(FAQ $faq)
    {
        ClearCachedAttributes::clear($faq->id, ['faq_question', 'faq_answer']);
    }
}
