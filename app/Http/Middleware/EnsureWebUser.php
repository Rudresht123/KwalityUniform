<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureWebUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // If the user is an admin, vendor, or school, they must be on the dashboard.
            if ($user->hasAnyRole(['super-admin', 'admin', 'school', 'vendor'])) {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
