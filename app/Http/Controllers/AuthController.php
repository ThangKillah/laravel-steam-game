<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
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

        $userId = Hashids::decode($request->get('id'))[0];

        return $this->userRepository->loginDisqus($userId);
    }

    public function login(LoginRequest $request)
    {
        try {
            $remember = (bool)$request->get('remember', false);
            if (Sentinel::authenticate($request->all(), $remember)) {
                return redirect()->intended($this->redirectTo);
            } else {
                $err = __('That password was incorrect. Please try again.');
            }
        } catch (NotActivatedException $e) {
            $err = __('Your account is not active');
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $err = __('Your account is blocked in delay sec', ['delay' => $delay]);
        }
        return redirect()->back()
            ->withInput()
            ->with('errLogin', $err);
    }
}
