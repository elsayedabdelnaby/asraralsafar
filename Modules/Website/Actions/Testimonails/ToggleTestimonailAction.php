<?php

namespace Modules\Website\Actions\Testimonails;

use Modules\Website\Entities\Testimonail;
use Modules\Website\Http\Requests\Testimonails\ToggleTestimonailRequest;

/**
 * @purpose toggle the testimonail status
 */
class ToggleTestimonailAction
{
    /**
     * @param ToggletestimonailRequest $request
     */
    public function handle(ToggletestimonailRequest $request): bool
    {
        $testimonail = Testimonail::find($request->id);
        $testimonail->is_active = !$testimonail->is_active;
        return $testimonail->save();
    }
}
