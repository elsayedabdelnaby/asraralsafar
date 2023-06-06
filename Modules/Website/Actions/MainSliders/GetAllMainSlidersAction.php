<?php

namespace Modules\Website\Actions\MainSliders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Website\Entities\MainSlider;

/**
 * handle get all main sliders
 */
class GetAllMainSlidersAction
{
    public function handle()
    {
        return MainSlider::select(
            'id',
            'is_active',
            'display_order',
            DB::raw('CONCAT("' . asset(Storage::url('website/main_sliders')) . '/' . '", image) as image'),
            DB::raw('null as Actions')
        )->get();
    }
}
