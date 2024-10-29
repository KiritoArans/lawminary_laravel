<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the accountType of 'Admin'
        if (Auth::check() && Auth::user()->accountType === 'Admin') {
            return $next($request);
        }
        return redirect('/admod/login')->withErrors([
            'error' => 'Unauthorized Access',
        ]);
    }
}
