<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\AboutUs;
use App\Services\Cache\ClearCachedAttributes;

class AboutUsObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the AboutUs "updated" event.
     *
     * @param  \Modules\Website\Entites\AboutUs  $aboutUs
     * @return void
     */
    public function updated(AboutUs $aboutUs)
    {
        ClearCachedAttributes::clear($aboutUs->id, ['about_us_title', 'about_us_description']);
    }

    /**
     * Handle the AboutUs "deleted" event.
     *
     * @param  \Modules\Website\Entites\AboutUs  $aboutUs
     * @return void
     */
    public function deleted(AboutUs $aboutUs)
    {
        ClearCachedAttributes::clear($aboutUs->id, ['about_us_title', 'about_us_description']);
    }
}
