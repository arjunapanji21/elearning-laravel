<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('dashboard'));
        } else {
            return view('auth.login', [
                'title' => 'Login'
            ]);
        }
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect(route('dashboard'));
        } else {
            return view('auth.register', [
                'title' => 'Registration',
            ]);
        }
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('dashboard'));
        }

        return back()->with(['error', 'Login failed!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('user.login'));
    }

    public function forgot_password(Request $request)
    {
        return view('auth.forgot', [
            'title' => 'Forgot Password',
        ]);
    }
}
