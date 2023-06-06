<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $response = [
            'status' => false,
            'message' => null,
            'token' => null,
            'otp' => null,
            'is_verified' => false,
            'user' => null,
        ];
        $device_name = $args['device_name'];
        unset($args['device_name']);
        // Determine if the login parameter is an email or a phone number
        $loginField = filter_var($args['emailOrPhone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        //check if the email or phone number is valid
        $user = User::where([
            [$loginField, $args['emailOrPhone']],
        ])->first();

        $response['is_verified'] = $user?->phone_verified_at ? true : false;

        if (!$user || !Hash::check($args['password'], $user->password)) {
            $response['message'] = __('general.the_provided_credentials_are_incorrect');
        } elseif (!$user->phone_verified_at) {
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $user->otp = $otp;
            $user->save();
            app(SessionInterface::class)->put($loginField, $args['emailOrPhone']);
            app(SessionInterface::class)->put('otp', $otp);
            app(SessionInterface::class)->put('device_name', $device_name);
            $response['message'] = __('general.customer_not_verified_yet');
            $response['otp'] = $otp;
            $response['status'] = true;
        } else {
            $response['token'] = $user->createToken($device_name)->plainTextToken;
        }

        return $response;;
    }
}
