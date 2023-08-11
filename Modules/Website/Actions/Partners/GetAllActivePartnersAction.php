<?php

namespace Modules\Website\Actions\Partners;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Website\Entities\Partner;

/**
 * handle get all active partners action
 */
class GetAllActivePartnersAction
{
    public function handle()
    {
        return Partner::select(
            'id',
            'logo',
            'display_order',
            'is_active',
            DB::raw('CONCAT("' . asset(Storage::url('website/partners')) . '/' . '", logo) as logo_url'),
            DB::raw('null as Actions')
        )->active()->get();
    }
}
