<?php

namespace Modules\Website\Actions\AboutUs;

use Modules\Website\Entities\AboutUs;
use Modules\Website\Entities\AboutUsTranslation;
use Modules\Website\Http\Requests\AboutUs\DeleteAboutUsRequest;

/**
 * handle delete a about us
 */
class DeleteAboutUsAction
{
    public function handle(DeleteAboutUsRequest $request): bool
    {
        // delete all translations of this about us
        AboutUsTranslation::where('about_us_id', $request->id)->delete();
        // delete a about us
        $aboutUs = AboutUs::findOrFail($request->id);

        return $aboutUs->delete();
    }
}
