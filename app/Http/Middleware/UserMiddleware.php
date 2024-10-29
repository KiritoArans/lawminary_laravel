<?php

namespace App\Http\Middleware;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the accountType of 'User'
        if (
            Auth::check() &&
            Auth::user()->accountType === 'User, Lawyer, Admin, Moderator'
        ) {
            return $next($request);
        }
        return redirect('/login')->withErrors([
            'error' => 'Unauthorized Access',
        ]);
    }
}
