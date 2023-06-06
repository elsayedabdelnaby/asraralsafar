<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class ForgetPassword
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $phone_number = $args['phone_number'];
        $user = User::where('phone_number', $phone_number)->first();
        if ($user) {
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $user->otp = $otp;
            $user->save();
            app(SessionInterface::class)->put('phone_number', $args['phone_number']);
            return [
                'status' => true,
                'otp' => $otp
            ];
        } else {
            return [
                'status' => false,
                'message' => __('general.phone_number_does_not_exist')
            ];
        }
    }
}
