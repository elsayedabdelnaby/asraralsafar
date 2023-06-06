<?php

namespace Modules\Website\Actions\Footer\Sections;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\FooterSection;

/**
 * @purpose get all active footer sections
 */
class GetAllActiveFooterSectionsAction
{
    public function handle()
    {
        return FooterSection::currentLanguageTranslation('footer_sections', 'footer_section_translations', 'footer_section_id')
            ->select(
                'footer_sections.id',
                'name',
                'is_active',
                'display_order',
                DB::raw('null as Actions')
            )->active()->get();
    }
}
