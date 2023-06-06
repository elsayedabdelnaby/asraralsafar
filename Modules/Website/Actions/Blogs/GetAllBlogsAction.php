<?php

namespace Modules\Website\Actions\Blogs;

use Modules\Website\Entities\Blog;

/**
 * handle get all blogs condition
 */
class GetAllBlogsAction
{
    public function handle()
    {
        $blogs = Blog::currentLanguageTranslation('blogs', 'blog_translations', 'blog_id')
            ->withCategory('blogs.id');
        return $blogs;
    }
}
