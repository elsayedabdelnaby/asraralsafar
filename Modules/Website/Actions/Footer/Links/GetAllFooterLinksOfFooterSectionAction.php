<?php

namespace Modules\Website\Actions\Footer\Links;

use Modules\Website\Entities\FooterLink;

/**
 * @purpose get all footer links of the footer section
 */
class GetAllFooterLinksOfFooterSectionAction
{
    /**
     * @param int $footer_section_id
     */
    public function handle(int $footer_section_id)
    {
        return FooterLink::currentLanguageTranslation('footer_links', 'footer_link_translations', 'footer_link_id')
            ->where('footer_section_id', $footer_section_id);
    }
}
