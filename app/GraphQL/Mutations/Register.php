<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class Register
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context)
    {
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $user = User::create([
            'email' => $args['input']['email'] ?? null,
            'phone_number' => $args['input']['phone'],
            'password' => Hash::make($args['input']['password']),
            'otp' => $otp,
            'type' => 'customer',
            'news_letter' => $args['input']['news_letter']
        ]);

        if ($context->user()) {
            $context->user->currentAccessToken()->delete();
        }

        app(SessionInterface::class)->put('phone_number', $args['input']['phone']);
        app(SessionInterface::class)->put('otp', $otp);
        app(SessionInterface::class)->put('device_name', $args['input']['device_name']);

        return $user;
    }
}
