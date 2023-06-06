<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class ResendOTP
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $phone_number = app(SessionInterface::class)->get('phone_number');

        $user = User::where('phone_number', $phone_number)->firstOrFail();
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $user->otp = $otp;
        $user->save();
        return ['otp' => $otp];
    }
}
