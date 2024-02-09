<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $user = User::createClient($attributes);
        // auth()->login($user);
        return redirect()->route('home')->with('success', 'Your account has been created.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Log the user in
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        }

        // Redirect the user
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
