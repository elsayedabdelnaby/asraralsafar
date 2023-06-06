<?php

namespace Modules\Website\Actions\Footer\Sections;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\FooterSection;

/**
 * @purpose get all footer sections
 */
class GetAllFooterSectionsAction
{
    public function handle()
    {
        return FooterSection::currentLanguageTranslation('footer_sections', 'footer_section_translations', 'footer_section_id');
    }
}
