<?php

namespace Modules\Website\Actions\Services;

use Modules\Website\Entities\Service;
use Modules\Website\Http\Requests\Services\ToggleServiceRequest;

/**
 * @purpose toggle the service status
 */
class ToggleServiceAction
{
    /**
     * @param ToggleServiceRequest $request
     */
    public function handle(ToggleServiceRequest $request): bool
    {
        $service = Service::find($request->id);
        $service->is_active = !$service->is_active;
        return $service->save();
    }
}
