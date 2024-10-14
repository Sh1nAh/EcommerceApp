<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->guard()->user();

        // Check if user is authenticated
        if ($user) {
            // Check if the user is an instance of User and is an admin
            if ($user instanceof \App\Models\User && $user->isAdmin()) {
                return redirect('/admin');
            }

            // If the user is logged in but not an admin, you may redirect as needed
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        return $next($request); // Allow guests to proceed
    }
}
