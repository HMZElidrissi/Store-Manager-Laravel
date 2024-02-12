<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        // auth()->login($user);
        Session::put('user', $user);
        return redirect()->route('home')->with('success', 'Welcome to our platform!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // using the attempt method in the auth helper
        /*
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        */

        // using session based authentication
        $user = $this->clientRepository->findByEmail($credentials['email']);
        if(!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        Session::put('user', $user);

        return redirect()->route('home')->with('success', 'Welcome back!');
    }

    public function logout(Request $request)
    {
        // using the logout method in the auth helper
        /*
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Goodbye!');
        */
        Session::forget('user');
        Session::flush();
        return redirect()->route('home')->with('success', 'Goodbye!');
    }

    public function showResetForm()
    {
        return view('auth.forgot-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showUpdatePasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
