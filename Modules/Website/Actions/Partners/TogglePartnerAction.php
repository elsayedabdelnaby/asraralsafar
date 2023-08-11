<?php

namespace Modules\Website\Actions\Partners;

use Modules\Website\Entities\Partner;
use Modules\Website\Http\Requests\Partners\TogglePartnerRequest;

/**
 * @purpose toggle the partner status
 */
class TogglePartnerAction
{
    /**
     * @param TogglePartnerRequest $request
     */
    public function handle(TogglePartnerRequest $request): bool
    {
        $partner = Partner::find($request->id);
        $partner->is_active = !$partner->is_active;
        return $partner->save();
    }
}
