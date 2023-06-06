<?php

namespace Modules\Website\GraphQL\Queries;

use Modules\Website\Entities\Blog;

/**
 * return only the footer sections which have at least one active footer link
 */
final class BlogsResolver
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if (isset($args['category_id'])) {
            $category_id = $args['category_id'];
            return Blog::whereHas('categories', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->get();
        }
        return Blog::with('comments')->get();
    }
}
