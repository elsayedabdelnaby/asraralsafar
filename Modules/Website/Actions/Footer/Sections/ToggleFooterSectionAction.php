<?php

namespace Modules\Website\Actions\Footer\Sections;

use Modules\Website\Entities\FooterSection;
use Modules\Website\Http\Requests\Footer\Sections\ToggleFooterSectionRequest;

/**
 * @purpose toggle the footer section status
 */
class ToggleFooterSectionAction
{
    /**
     * @param ToggleFooterSectionRequest $request
     */
    public function handle(ToggleFooterSectionRequest $request): bool
    {
        $footer_section = FooterSection::find($request->id);
        $footer_section->is_active = !$footer_section->is_active;
        return $footer_section->save();
    }
}
