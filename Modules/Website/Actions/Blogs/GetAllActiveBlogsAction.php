<?php

namespace Modules\Website\Actions\Blogs;

use Modules\Website\Entities\Blog;

/**
 * handle get all active blogs
 */
class GetAllActiveBlogsAction
{
    public function handle()
    {
        $blogs = Blog::currentLanguageTranslation('blogs', 'blog_translations', 'blog_id')
            ->withCategory('blogs.category_id')
            ->active();
        return $blogs;
    }
}
