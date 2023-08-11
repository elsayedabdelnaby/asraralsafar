<?php

namespace Modules\Website\Actions\AboutUs;

use Modules\Website\Entities\AboutUs;
use Modules\Website\Entities\AboutUsTranslation;
use Modules\Website\Http\Requests\AboutUs\UpdateAboutUsRequest;

/**
 * handle update a About Us
 */
class UpdateAboutUsAction
{
    public function handle(UpdateAboutUsRequest $request, AboutUs $aboutUs): AboutUs
    {
        $aboutUs->display_order = $request->display_order;
        $aboutUs->is_active = $request->is_active ? true : false;
        $aboutUs->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            AboutUsTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'about_us_id' => $aboutUs->id
                ],
                [
                    'title' => $translation['title'],
                    'description' => $translation['description']
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($aboutUs->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            AboutUsTranslation::where([
                ['language_id', '=', $language_id],
                ['about_us_id', '=', $aboutUs->id]
            ])->delete();
        }

        return $aboutUs;
    }
}
