<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
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
}
