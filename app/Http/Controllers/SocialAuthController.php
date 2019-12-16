<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Sentinel;
use Socialite;

class SocialAuthController extends Controller
{
    public function getKeyEncode()
    {
        return str_replace('.', '', request()->ip()) . '_url';
    }

    public function redirect($social, Request $request)
    {
        if ($request->has('nextUrl')) {
            session()->put($this->getKeyEncode(), $request->get('nextUrl'));
        }
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        dd(session()->all());
        try {
//            $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
//            Sentinel::login($user);
            dd(session()->get('_previous'));
            return redirect()->to('/');
        } catch (Exception $exception) {
            return abort(404);
        }
    }
}
