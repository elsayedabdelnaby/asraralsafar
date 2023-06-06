<?php

namespace Modules\Settings\Actions\Tags;

use Modules\Settings\Entities\Tag;
use Modules\Settings\Entities\TagTranslation;
use Modules\Settings\Http\Requests\Tags\StoreTagRequest;

/**
 * handle creation of tag
 */
class StoreTagAction
{
    /**
     * @param StoreTagRequest $request
     */
    public function handle(StoreTagRequest $request): Tag
    {
        $tag = new Tag();
        $tag->is_active = $request->is_active ? true : false;
        $tag->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'tag_id' => $tag->id,
            ];

            TagTranslation::create($translation_data);
        }

        return $tag;
    }
}
