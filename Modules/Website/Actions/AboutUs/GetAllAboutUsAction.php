<?php

namespace Modules\Website\Actions\AboutUs;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\AboutUs;

/**
 * handle get all terms condition
 */
class GetAllAboutUsAction
{
    public function handle()
    {
        $aboutUs = AboutUs::currentLanguageTranslation('about_us', 'about_us_translations', 'about_us_id')
            ->select(
                'about_us.id',
                'about_us_translations.title',
                'about_us_translations.description',
                'about_us.display_order',
                'about_us.is_active',
                DB::raw('null as Actions')
            );
        return $aboutUs->get();
    }
}
