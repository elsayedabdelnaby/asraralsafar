<?php

namespace App\GraphQL\Mutations;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateCustomerNameAndAvater
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     * @param GraphQLContext $context
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $user = $context->user;
        $user->update([
            'name' => $args['name'],
            'avatar_id' => $args['avatar_id'],
        ]);

        return $user;
    }
}
