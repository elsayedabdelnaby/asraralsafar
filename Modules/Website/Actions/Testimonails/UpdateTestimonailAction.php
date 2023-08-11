<?php

namespace Modules\Website\Actions\Testimonails;

use Modules\Website\Entities\Testimonail;
use Modules\Website\Entities\TestimonailTranslation;
use Modules\Website\Http\Requests\Testimonails\UpdateTestimonailRequest;

/**
 * handle update a testimonail condition
 */
class UpdateTestimonailAction
{
    public function handle(UpdateTestimonailRequest $request): Testimonail
    {
        $testimonail = Testimonail::find($request->id);
        $testimonail->display_order = $request->display_order;
        $testimonail->is_active = $request->is_active ? true : false;
        $testimonail->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            TestimonailTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'testimonail_id' => $testimonail->id
                ],
                [
                    'client_name' => $translation['client_name'],
                    'testimonail' => $translation['testimonail']
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($testimonail->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            TestimonailTranslation::where([
                ['language_id', '=', $language_id],
                ['testimonail_id', '=', $testimonail->id]
            ])->delete();
        }

        return $testimonail;
    }
}
