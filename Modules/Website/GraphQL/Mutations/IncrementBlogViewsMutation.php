<?php

namespace Modules\Website\GraphQL\Mutations;

use Modules\Website\Entities\Blog;
use Illuminate\Contracts\Queue\EntityNotFoundException;

/**
 * update the views number of the blog
 */
final class IncrementBlogViewsMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     * @return Blog
     */
    public function __invoke($_, array $args): Blog
    {
        $blog = Blog::find($args['id']);
        if ($blog) {
            $blog->increment('views_number');
            return $blog;
        } else {
            throw new EntityNotFoundException("Blog", $args['id']);
        }
    }
}
