<?php

namespace Modules\Website\Actions\Testimonails;

use Modules\Website\Entities\Testimonail;
use Modules\Website\Entities\TestimonailTranslation;
use Modules\Website\Http\Requests\Testimonails\StoreTestimonailRequest;

/**
 * handle create a testimonail
 */
class StoreTestimonailAction
{
    public function handle(StoreTestimonailRequest $request): Testimonail
    {
        $testimonail = new Testimonail();
        $testimonail->is_active = $request->is_active ? true : false;
        $testimonail->display_order = $request->display_order ? $request->display_order : 0;
        $testimonail->save();

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'client_name' => $translation['client_name'],
                'testimonail' => $translation['testimonail'],
                'language_id' => $translation['language_id'],
                'testimonail_id' => $testimonail->id,
            ];

            TestimonailTranslation::create($translation_data);
        }

        return $testimonail;
    }
}
