<?php

namespace Modules\Website\Actions\Footer\Sections;

use Modules\Website\Entities\FooterSection;
use Modules\Website\Entities\FooterSectionTranslation;
use Modules\Website\Http\Requests\Footer\Sections\StoreFooterSectionRequest;

/**
 * @purpose create a footer section
 */
class StoreFooterSectionAction
{
    /**
     * @param StoreFooterSectionRequest $request
     * @return FooterSection
     */
    public function handle(StoreFooterSectionRequest $request): FooterSection
    {
        $footer_section = new FooterSection();
        $footer_section->is_active = $request->is_active ? true : false;
        $footer_section->display_order = $request->display_order ? $request->display_order : 0;
        $footer_section->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'footer_section_id' => $footer_section->id,
            ];

            FooterSectionTranslation::create($translation_data);
        }

        return $footer_section;
    }
}
