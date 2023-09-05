<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\Service;
use App\Services\Cache\ClearCachedAttributes;

class ServiceObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Service "updated" event.
     *
     * @param  \Modules\Website\Entites\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        ClearCachedAttributes::clear($service->id, ['service_name', 'service_description', 'service_slug', 'meta_title', 'meta_description']);
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param  \Modules\Website\Entites\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        ClearCachedAttributes::clear($service->id, ['service_name', 'service_description', 'service_slug', 'meta_title', 'meta_description']);
    }
}
