<?php

namespace Modules\Website\Actions\AboutUs;

use Modules\Website\Entities\AboutUs;
use Modules\Website\Entities\AboutUsTranslation;
use Modules\Website\Http\Requests\AboutUs\StoreAboutUsRequest;

/**
 * handle create a AboutUs
 */
class StoreAboutUsAction
{
    public function handle(StoreAboutUsRequest $request): AboutUs
    {
        $aboutUs = new AboutUs();
        $aboutUs->is_active = $request->is_active ? true : false;
        $aboutUs->display_order = $request->display_order ? $request->display_order : 0;
        $aboutUs->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'title' => $translation['title'],
                'description' => $translation['description'],
                'language_id' => $translation['language_id'],
                'about_us_id' => $aboutUs->id,
            ];

            AboutUsTranslation::create($translation_data);
        }

        return $aboutUs;
    }
}
