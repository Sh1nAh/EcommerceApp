<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function destroy()
    {
        auth()->guard()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}
