<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class VerifyForgetPasswordOTP
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $phone_number = app(SessionInterface::class)->get('phone_number');
        $user = User::where('phone_number', $phone_number)->firstOrFail();

        if ($user->otp != $args['otp']) {
            return false;
        }

        return true;
    }
}
