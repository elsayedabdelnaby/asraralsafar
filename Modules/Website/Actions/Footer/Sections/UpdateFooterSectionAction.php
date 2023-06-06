<?php

namespace Modules\Website\Actions\Footer\Sections;

use Modules\Website\Entities\FooterSection;
use Modules\Website\Entities\FooterSectionTranslation;
use Modules\Website\Http\Requests\Footer\Sections\UpdateFooterSectionRequest;

/**
 * @purpose update a footer section
 */
class UpdateFooterSectionAction
{
    /**
     * @param UpdateFooterSectionRequest $request
     * @return FooterSection
     */
    public function handle(UpdateFooterSectionRequest $request): FooterSection
    {
        $footer_section = FooterSection::find($request->id);
        $footer_section->is_active = $request->is_active ? true : false;
        $footer_section->display_order = $request->display_order ? $request->display_order : 0;
        $footer_section->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            FooterSectionTranslation::updateOrCreate(
                ['language_id' => $translation['language_id'], 'footer_section_id' => $footer_section->id],
                ['name' => $translation['name']]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($footer_section->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            FooterSectionTranslation::where([
                ['language_id', '=', $language_id],
                ['footer_section_id', '=', $footer_section->id]
            ])->delete();
        }

        return $footer_section;
    }
}
