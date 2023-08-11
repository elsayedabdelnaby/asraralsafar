<?php

namespace Modules\Website\Actions\SocialLinks;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Website\Entities\SocialLink;

/**
 * handle get all active social links action
 */
class GetAllActiveSocialLinksAction
{
    public function handle()
    {
        return SocialLink::select(
            'id',
            'icon',
            'url',
            'display_order',
            'is_active',
            DB::raw('CONCAT("' . asset(Storage::url('website/social_links')) . '/' . '", icon) as icon_url'),
            DB::raw('null as Actions')
        )->active();
    }
}
