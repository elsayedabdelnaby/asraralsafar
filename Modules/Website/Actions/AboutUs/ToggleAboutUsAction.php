<?php

namespace Modules\Website\Actions\AboutUs;

use Modules\Website\Entities\AboutUs;
use Modules\Website\Http\Requests\AboutUs\ToggleAboutUsRequest;

/**
 * @purpose toggle the about us status
 */
class ToggleAboutUsAction
{
    /**
     * @param ToggleAboutUsRequest $request
     */
    public function handle(ToggleAboutUsRequest $request): bool
    {
        $aboutUs = AboutUs::find($request->id);
        $aboutUs->is_active = !$aboutUs->is_active;
        return $aboutUs->save();
    }
}
