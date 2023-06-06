<?php

namespace Modules\Website\Observers;

use App\Services\Cache\ClearCachedAttributes;
use Modules\Website\Entities\WebsiteInformation;

class WebsiteInformationObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the WebsiteInformation "updated" event.
     *
     * @param  \Modules\Website\Entites\WebsiteInformation  $website_information
     * @return void
     */
    public function updated(WebsiteInformation $website_information)
    {
        ClearCachedAttributes::clear($website_information->id, ['website_information']);
    }
}
