<?php

namespace Modules\Website\Observers;

use App\Services\Cache\ClearCachedAttributes;
use Modules\Website\Entities\MetaPage;

class MetaPageObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the MetaPage "updated" event.
     *
     * @param  \Modules\Website\Entites\MetaPage  $meta_page
     * @return void
     */
    public function updated(MetaPage $meta_page)
    {
        ClearCachedAttributes::clear($meta_page->id, ['meta_page_title', 'meta_page_description']);
    }

    /**
     * Handle the MetaPage "deleted" event.
     *
     * @param  \Modules\Website\Entites\MetaPage  $meta_page
     * @return void
     */
    public function deleted(MetaPage $meta_page)
    {
        ClearCachedAttributes::clear($meta_page->id, ['meta_page_title', 'meta_page_description']);
    }
}
