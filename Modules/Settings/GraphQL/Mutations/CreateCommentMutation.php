<?php

namespace Modules\Settings\GraphQL\Mutations;

use Modules\Settings\Entities\Comment;

final class CreateCommentMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $commentable_type = $args['commentable_type'];
        $commentable_id = $args['commentable_id'];
        $body = $args['body'];
        $created_by = $args['author_id'];

        $comment = new Comment();
        $comment->commentable_type = $commentable_type;
        $comment->commentable_id = $commentable_id;
        $comment->body = $body;
        $comment->created_by = $created_by;
        $comment->updated_by = $created_by;

        $comment->save();

        return $comment;
    }
}
