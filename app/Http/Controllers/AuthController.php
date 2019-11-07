<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Sentinel;

class AuthController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        $this->userRepository->register($request->all());
        return redirect()->route('home');
    }

    public function logout()
    {
        Sentinel::logout();
        return redirect()->route('home');
    }

    public function loginWithDisqus(Request $request)
    {
        $request->validate([
            'id' => ['required', 'min:' . config('hashids.connections.main.length')],
        ]);

        $userId = \Hashids::decode($request->get('id'))[0];

        return $this->userRepository->loginDisqus($userId);
    }
}
