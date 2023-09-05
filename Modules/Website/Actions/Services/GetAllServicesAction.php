<?php

namespace Modules\Website\Actions\Services;

use Modules\Website\Entities\Service;

/**
 * handle get all services condition
 */
class GetAllServicesAction
{
    public function handle()
    {
        return Service::currentLanguageTranslation('services', 'service_translations', 'service_id');
    }
}
