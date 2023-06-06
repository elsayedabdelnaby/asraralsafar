<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\FooterLink;
use App\Services\Cache\ClearCachedAttributes;

class FooterLinkObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the FooterLink "updated" event.
     *
     * @param  \Modules\Website\Entites\FooterLink  $footer_link
     * @return void
     */
    public function updated(FooterLink $footer_link)
    {
        ClearCachedAttributes::clear($footer_link->id, ['footer_link']);
    }

    /**
     * Handle the FooterLink "deleted" event.
     *
     * @param  \Modules\Website\Entites\FooterLink  $footer_link
     * @return void
     */
    public function deleted(FooterLink $footer_link)
    {
        ClearCachedAttributes::clear($footer_link->id, ['footer_link']);
    }
}
