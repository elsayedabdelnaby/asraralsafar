<?php

namespace Modules\Website\Actions\Services;

use Modules\Website\Entities\Service;
use Modules\Website\Entities\ServiceTranslation;
use Modules\Website\Http\Requests\Services\DeleteServiceRequest;

/**
 * handle delete a service
 */
class DeleteServiceAction
{
    public function handle(DeleteServiceRequest $request): bool
    {
        // delete all translations of this service
        ServiceTranslation::where('service_id', $request->id)->delete();
        // delete a service
        $service = Service::findOrFail($request->id);

        return $service->delete();
    }
}
