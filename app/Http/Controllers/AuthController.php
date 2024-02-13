<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\ClientRepository;
use App\Services\EmailService;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function __construct(protected ClientRepository $clientRepository, protected EmailService $emailService)
    {
        $this->clientRepository = $clientRepository;
        $this->emailService = $emailService;
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $attributes = $this->clientRepository->uploadAvatar($request, $attributes);
        $user = $this->clientRepository->create($attributes);
        auth()->login($user);
        return redirect()->route('home')->with('success', 'Welcome to our platform!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('table')->with('success', 'Goodbye!');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = $this->clientRepository->findByEmail($request->email);
        if (!$user){
            return redirect()->back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        } else {
            $token = Password::createToken($user);
            $this->emailService->sendPasswordResetLink($user, $token);
            return redirect()->route('login')->with('status', 'We have emailed your password reset link!');
        }
    }

    public function showResetForm($token)
    {
        return view('auth.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:5',
        ]);

        $user = $this->clientRepository->findByEmail($request->email);

        if (!$user || !Password::tokenExists($user, $request->token)) {
            return redirect()->back()->withErrors(['email' => 'This password reset token is invalid.']);
        }

        $this->clientRepository->update($user->id, ['password' => $request->password]);
        Password::deleteToken($user);

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }
}
