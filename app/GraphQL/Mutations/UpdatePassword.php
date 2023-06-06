<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class UpdatePassword
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
            'otp' => null,
            'is_verified' => false,
            'user' => null,
        ];

        $phone_number = app(SessionInterface::class)->get('phone_number');
        $user = User::where('phone_number', $phone_number)->first();
        $user->password = Hash::make($args['password']);
        $user->phone_verified_at = now();
        $user->save();

        $response['status'] = true;
        $response['token'] = $user->createToken($args['device_name'])->plainTextToken;
        $response['message'] = __('general.password_updated_successfully');
        $response['is_verified'] = true;
        $response['user'] = $user;
        return $response;;
    }
}
