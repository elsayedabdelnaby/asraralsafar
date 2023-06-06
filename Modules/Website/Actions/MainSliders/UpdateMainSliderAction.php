<?php

namespace Modules\Website\Actions\MainSliders;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\MainSlider;
use Modules\Website\Http\Requests\MainSliders\UpdateMainSliderRequest;

/**
 * handle update a main slider condition
 */
class UpdateMainSliderAction
{
    use FileUploadTrait;

    public function handle(UpdateMainSliderRequest $request): MainSlider
    {
        $main_slider = MainSlider::find($request->id);

        $image = $main_slider->image ? $main_slider->image : '';

        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/main_sliders');
        }

        $main_slider->is_active = $request->is_active ? true : false;
        $main_slider->display_order = $request->display_order;
        $main_slider->image = $image;
        $main_slider->save();

        return $main_slider;
    }
}
