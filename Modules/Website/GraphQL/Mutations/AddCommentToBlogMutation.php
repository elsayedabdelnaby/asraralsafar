<?php

namespace Modules\Website\GraphQL\Mutations;

use Modules\Website\Entities\Blog;
use Modules\Settings\GraphQL\Mutations\CreateCommentMutation;

final class AddCommentToBlogMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $blog = Blog::findOrFail($args['blog_id']);

        $comment = app(CreateCommentMutation::class)(null, [
            'commentable_type' => get_class($blog),
            'commentable_id' => $blog->id,
            'body' => $args['body'],
            'author_id' => $args['author_id'],
        ]);

        return $comment;
    }
}
