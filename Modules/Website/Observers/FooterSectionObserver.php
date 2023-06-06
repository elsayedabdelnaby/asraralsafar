<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\FooterSection;
use App\Services\Cache\ClearCachedAttributes;

class FooterSectionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the FooterSection "updated" event.
     *
     * @param  \Modules\Website\Entites\FooterSection  $footer_section
     * @return void
     */
    public function updated(FooterSection $footer_section)
    {
        ClearCachedAttributes::clear($footer_section->id, ['footer_section']);
    }

    /**
     * Handle the FooterSection "deleted" event.
     *
     * @param  \Modules\Website\Entites\FooterSection  $footer_link
     * @return void
     */
    public function deleted(FooterSection $footer_section)
    {
        ClearCachedAttributes::clear($footer_section->id, ['footer_section']);
    }
}
