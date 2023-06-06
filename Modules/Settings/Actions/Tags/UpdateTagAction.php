<?php

namespace Modules\Settings\Actions\Tags;

use Modules\Settings\Entities\Tag;
use Modules\Settings\Entities\TagTranslation;
use Modules\Settings\Http\Requests\Tags\UpdateTagRequest;

/**
 * @purpose update the tag
 */
class UpdateTagAction
{
    /**
     * @param UpdateTagRequest $request
     * @return Tag
     */
    public function handle(UpdateTagRequest $request): Tag
    {
        $tag = Tag::find($request->id);
        $tag->is_active = $request->is_active ? true : false;
        $tag->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            TagTranslation::updateOrCreate(
                ['language_id' => $translation['language_id'], 'tag_id' => $tag->id],
                ['name' => $translation['name']]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($tag->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            TagTranslation::where([
                ['language_id', '=', $language_id],
                ['tag_id', '=', $tag->id]
            ])->delete();
        }

        return $tag;
    }
}
