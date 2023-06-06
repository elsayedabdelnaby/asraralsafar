<?php

namespace Modules\Website\Actions\Footer\Sections;

use Modules\Website\Entities\FooterSection;
use Modules\Website\Http\Requests\Footer\Sections\DeleteFooterSectionRequest;

/**
 * @purpose delete a footer section
 */
class DeleteFooterSectionAction
{
    /**
     * @param DeleteFooterSectionRequest $request
     * @return boolean
     */
    public function handle(DeleteFooterSectionRequest $request): bool
    {
        $footer_section = FooterSection::find($request->id);

        // delete all translations of this item
        $footer_section->translations()->delete();

        // delete all footer links of this footer section
        $footer_section->footerlinks()?->delete();

        return $footer_section->delete();
    }
}
