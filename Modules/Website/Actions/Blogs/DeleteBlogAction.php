<?php

namespace Modules\Website\Actions\Blogs;

use Modules\Website\Entities\Blog;
use Modules\Website\Entities\BlogTranslation;
use Modules\Website\Http\Requests\Blogs\DeleteBlogRequest;

/**
 * handle delete a blog
 */
class DeleteBlogAction
{
    public function handle(DeleteBlogRequest $request): bool
    {
        // delete all translations of this blog
        BlogTranslation::where('blog_id', $request->id)->delete();
        // delete a blog
        $blog = Blog::findOrFail($request->id);

        return $blog->delete();
    }
}
