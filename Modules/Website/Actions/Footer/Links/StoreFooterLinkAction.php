<?php

namespace Modules\Website\Actions\Footer\Links;

use Modules\Website\Entities\FooterLink;
use Modules\Website\Entities\FooterLinkTranslation;
use Modules\Website\Http\Requests\Footer\Links\StoreFooterLinkRequest;

/**
 * @purpose create a footer link
 */
class StoreFooterLinkAction
{
    /**
     * @param StoreFooterLinkRequest $request
     */
    public function handle(StoreFooterLinkRequest $request): FooterLink
    {
        $footer_link = new FooterLink();
        $footer_link->is_active = $request->is_active ? true : false;
        $footer_link->url = $request->url;
        $footer_link->display_order = $request->display_order ? $request->display_order : 0;
        $footer_link->footer_section_id = $request->footer_section_id;
        $footer_link->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'footer_link_id' => $footer_link->id,
            ];
            FooterLinkTranslation::create($translation_data);
        }
        return $footer_link;
    }
}
