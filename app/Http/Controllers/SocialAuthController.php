<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
            Cookie::queue($this->getKeyEncode(), $request->input('nextUrl'), 1);
        }
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $key = $this->getKeyEncode();
        try {
            $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
            Sentinel::login($user);

            $nextUrl = Cookie::get($this->getKeyEncode());
            if (!empty($nextUrl)) {
                return redirect()->to($nextUrl);
            }
            return redirect()->to('/');
        } catch (Exception $exception) {
            session()->forget($key);
            return abort(404);
        }
    }
}
