<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Sentinel;
use Socialite;

class SocialAuthController extends Controller
{
    public function getKeyEncode()
    {
        return str_replace('.', '', request()->ip()) . '_url' . Carbon::now()->toDateString();
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
        $key = $this->getKeyEncode();
        try {
            $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
            Sentinel::login($user);
            if (session()->has($key)) {
                $url = session()->get($key);
                session()->forget($key);
                return redirect()->to($url);
            }
            return redirect()->to('/');
        } catch (Exception $exception) {
            session()->forget($key);
            return abort(404);
        }
    }
}
