<?php

namespace Modules\Website\Actions\Services;

use Modules\Website\Entities\Service;

/**
 * handle get all active services
 */
class GetAllActiveServicesAction
{
    public function handle()
    {
        $services = Service::currentLanguageTranslation('services', 'service_translations', 'service_id')
            ->active();
        return $services;
    }
}
