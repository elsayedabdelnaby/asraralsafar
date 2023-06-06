<?php

namespace App\GraphQL\Mutations;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Logout
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     * @param  GraphQLContext $context
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $context->user->currentAccessToken()->delete();
        return $context->user;
    }
}
