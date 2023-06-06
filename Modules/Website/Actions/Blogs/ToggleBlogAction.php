<?php

namespace Modules\Website\Actions\Blogs;

use Modules\Website\Entities\Blog;
use Modules\Website\Http\Requests\Blogs\ToggleBlogRequest;

/**
 * @purpose toggle the blog status
 */
class ToggleBlogAction
{
    /**
     * @param ToggleBlogRequest $request
     */
    public function handle(ToggleBlogRequest $request): bool
    {
        $blog = Blog::find($request->id);
        $blog->is_active = !$blog->is_active;
        return $blog->save();
    }
}
