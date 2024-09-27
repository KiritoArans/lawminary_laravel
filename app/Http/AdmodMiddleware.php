<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdmodMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        // Check if the user is authenticated
        if (!Auth::guard($guard)->check()) {
            return redirect('/admod/login'); // Redirect to the login page if not authenticated
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check for admin routes
        if ($request->is('admin/*')) {
            if ($user->accountType !== 'Admin') {
                Auth::logout(); // Logout unauthorized user
                return redirect('/admod/login')->withErrors([
                    'loginError' => 'Unauthorized access to Admin area.',
                ]);
            }
        }

        // Check for moderator routes
        if ($request->is('moderator/*')) {
            if ($user->accountType !== 'Moderator') {
                Auth::logout(); // Logout unauthorized user
                return redirect('/admod/login')->withErrors([
                    'loginError' => 'Unauthorized access to Moderator area.',
                ]);
            }
        }

        // If everything is fine, proceed to the next request
        return $next($request);
    }
}
