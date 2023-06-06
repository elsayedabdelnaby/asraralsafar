<?php

namespace Modules\Settings\Actions\Tags;

use Modules\Settings\Entities\Tag;
use Modules\Settings\Http\Requests\Tags\ToggleTagRequest;

/**
 * @purpose toggle the tag status
 */
class ToggleTagAction
{
    /**
     * @param ToggleTagRequest $request
     */
    public function handle(ToggleTagRequest $request): bool
    {
        $tag = Tag::find($request->id);
        $tag->is_active = !$tag->is_active;
        return $tag->save();
    }
}
