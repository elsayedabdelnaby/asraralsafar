<?php

namespace Modules\Website\GraphQL\Mutations;

use Modules\Website\Entities\Blog;
use Illuminate\Contracts\Queue\EntityNotFoundException;

/**
 * update the views number of the blog
 */
final class IncrementBlogSharingMutation
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
            $blog->increment('sharings_number');
            return $blog;
        } else {
            throw new EntityNotFoundException("Blog", $args['id']);
        }
    }
}
