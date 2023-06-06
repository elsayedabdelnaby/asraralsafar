<?php

namespace Modules\Website\Actions\Footer\Links;

use Modules\Website\Entities\FooterLink;
use Modules\Website\Entities\FooterLinkTranslation;
use Modules\Website\Http\Requests\Footer\Links\UpdateFooterLinkRequest;

/**
 * @purpose update a footer link
 */
class UpdateFooterLinkAction
{
    /**
     * @param UpdateFooterLinkRequest $request
     * @return FooterLink
     */
    public function handle(UpdateFooterLinkRequest $request): FooterLink
    {
        $footer_link = FooterLink::find($request->id);
        $footer_link->is_active = $request->is_active ? true : false;
        $footer_link->url = $request->url;
        $footer_link->type = $request->type;
        $footer_link->display_order = $request->display_order ? $request->display_order : 0;
        $footer_link->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            FooterLinkTranslation::updateOrCreate(
                ['language_id' => $translation['language_id'], 'footer_link_id' => $footer_link->id],
                ['name' => $translation['name']]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($footer_link->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            FooterLinkTranslation::where([
                ['language_id', '=', $language_id],
                ['footer_link_id', '=', $footer_link->id]
            ])->delete();
        }

        return $footer_link;
    }
}
