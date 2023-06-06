<?php

namespace Modules\Website\Actions\MainSliders;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\MainSlider;
use Modules\Website\Http\Requests\MainSliders\StoreMainSliderRequest;

/**
 * handle create a main slider
 */
class StoreMainSliderAction
{
    use FileUploadTrait;

    public function handle(StoreMainSliderRequest $request): MainSlider
    {
        $image = '';
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/main_sliders');
        }

        $main_slider = new MainSlider();
        $main_slider->is_active = $request->is_active ? true : false;
        $main_slider->display_order = $request->display_order;
        $main_slider->image = $image;
        $main_slider->save();

        return $main_slider;
    }
}
