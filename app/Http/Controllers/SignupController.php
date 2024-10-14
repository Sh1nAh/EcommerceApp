<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function store(Request $request)
{
    Log::info($request->all());
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'terms' => 'required|accepted',
    ]);
    
    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Optionally, log in the user after registration
    auth()->guard()->login($user);

    // Redirect or return response
    // return redirect('/');
    return redirect('/')->with('success', 'Registration successful!');

}
}
