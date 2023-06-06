<?php

namespace Modules\Website\Actions\MainSliders;

use Modules\Website\Entities\MainSlider;
use Modules\Website\Http\Requests\MainSliders\DeleteMainSliderRequest;

/**
 * handle delete a main slider
 */
class DeleteMainSliderAction
{
    public function handle(DeleteMainSliderRequest $request): bool
    {
        // delete a main slider
        return MainSlider::findOrFail($request->id)->delete();
    }
}
