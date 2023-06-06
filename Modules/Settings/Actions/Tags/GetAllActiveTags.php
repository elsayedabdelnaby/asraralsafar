<?php

namespace Modules\Settings\Actions\Tags;

use Modules\Settings\Entities\Tag;

/**
 * @purpose get all tags
 */
class GetAllActiveTags
{
    public function handle()
    {
        return Tag::currentLanguageTranslation('tags', 'tag_translations', 'tag_id');
    }
}
