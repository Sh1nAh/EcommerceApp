<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'user_email' => 'required|email',
        'user_password' => 'required|min:6',
        'remember' => 'nullable|boolean',
    ]);

    $user = \App\Models\User::where('email', $request->user_email)->first();

    if (!$user) {
        return back()->withErrors([
            'user_email' => 'The provided email does not match our records.',
        ]);
    }

    if (Auth::attempt([
        'email' => $request->user_email,
        'password' => $request->user_password,
    ], $request->remember)) {
        if ($user->isAdmin()) {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/');
    } else {
        return back()->withErrors([
            'user_password' => 'The provided password is incorrect.',
        ]);
    }
}
}