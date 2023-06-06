<?php

namespace Modules\Settings\Actions\Tags;

use Modules\Settings\Entities\Tag;
use Modules\Settings\Http\Requests\Tags\DeleteTagRequest;

/**
 * @purpose delete a tag
 */
class DeleteTagAction
{
    /**
     * @param DeleteTagRequest $request
     * @return bool
     */
    public function handle(DeleteTagRequest $request): bool
    {
        $tag = Tag::find($request->id);

        // delete all translations of this item
        $tag->translations()->delete();
        
        return $tag->delete();
    }
}
