<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ModeratorMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the accountType of 'Moderator'
        if (Auth::check() && Auth::user()->accountType === 'Moderator') {
            return $next($request);
        }
        return redirect('/admod/login')->withErrors([
            'error' => 'Unauthorized Access',
        ]);
    }
}
