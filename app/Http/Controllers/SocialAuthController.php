<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Sentinel;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
        Sentinel::login($user);

        return redirect()->to('/home');
    }
}
