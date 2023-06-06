<?php

namespace Modules\Website\Actions\MainSliders;

use Modules\Website\Entities\MainSlider;
use Modules\Website\Http\Requests\MainSliders\ToggleMainSliderRequest;

/**
 * @purpose toggle the main slider status
 */
class ToggleMainSliderAction
{
    /**
     * @param ToggleMainSliderRequest $request
     */
    public function handle(ToggleMainSliderRequest $request): bool
    {
        $main_slider = MainSlider::find($request->id);
        $main_slider->is_active = !$main_slider->is_active;
        return $main_slider->save();
    }
}
