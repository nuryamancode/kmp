<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Authentice extends Controller
{
    public function showLoginForm()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email-username' => 'required|string',
            'password' => 'required|string',
        ],
        [
            'email-username.required' => 'Email/username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email-username', 'password');

        if (
            auth()->attempt(['email' => $credentials['email-username'], 'password' => $credentials['password']]) ||
            auth()->attempt(['username' => $credentials['email-username'], 'password' => $credentials['password']])
        ) {
            $user = auth()->user();
            $user->last_login_at = now();
            $user->save();
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email-username' => 'Email/username atau password salah.',
        ])->onlyInput('email-username');
    }


    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
