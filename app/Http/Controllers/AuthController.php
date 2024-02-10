<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\ClientRepository;

class AuthController extends Controller
{
    public function __construct(protected ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
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
}
