<?php

namespace Modules\Settings\GraphQL\Mutations;

use Modules\Settings\Entities\Comment;

final class AddReplyToCommentMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $comment = Comment::findOrFail($args['comment_id']);

        $reply = new Comment();
        $reply->commentable_id = $comment->commentable_id;
        $reply->commentable_type = $comment->commentable_type;
        $reply->body = $args['body'];
        $reply->created_by = $args['author_id'];
        $reply->updated_by = $args['author_id'];
        $reply->parent_id = $comment->id;
        $reply->save();

        return $reply;
    }
}
