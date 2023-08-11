<?php

namespace Modules\Website\Actions\Testimonails;

use Modules\Website\Entities\Testimonail;
use Modules\Website\Entities\TestimonailTranslation;
use Modules\Website\Http\Requests\Testimonails\DeleteTestimonailRequest;

/**
 * handle delete a Testimonail
 */
class DeleteTestimonailAction
{
    public function handle(DeleteTestimonailRequest $request): bool
    {
        // delete all translations of this Testimonail
        TestimonailTranslation::where('testimonail_id', $request->id)->delete();
        // delete a Testimonail
        $testimonail = Testimonail::findOrFail($request->id);

        return $testimonail->delete();
    }
}
