<?php

namespace App\Services;

use App\Model\SocialAccount;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $email = empty($providerUser->getEmail()) ? $providerUser->getId() . '@mail.com' : $providerUser->getEmail();
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            $user = User::whereEmail($email)->first();

            if (!$user) {
                $userName = $providerUser->getName();

                if ($social == 'steam') {
                    $responseUser = $providerUser->user;
                    $userName = $responseUser['personaname'];
                }

                $user = User::create([
                    'email' => $email,
                    'name' => $userName,
                    'password' => Hash::make(Str::random(10)),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}