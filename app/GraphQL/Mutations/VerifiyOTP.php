<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class VerifiyOTP
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $response = [
            'status' => false,
            'message' => null,
            'token' => null,
            'user' => null,
        ];
        $phone_number = app(SessionInterface::class)->get('phone_number');
        $otp = app(SessionInterface::class)->get('otp');

        if ($otp != $args['otp']) {
            $response['message'] = __('general.invalid_otp');
            return $response;
        }

        $user = User::where('phone_number', $phone_number)->firstOrFail();
        $user->phone_verified_at = now();
        $user->save();

        $token = $user->createToken(app(SessionInterface::class)->get('device_name'));
        $response['status'] = true;
        $response['is_verified'] = true;
        $response['user'] = $user;
        $response['token'] = $token->plainTextToken;
        return $response;
    }
}
