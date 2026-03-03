<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Allow if user has role 'admin' or 'super_admin', or has no roles yet (initial setup)
        if ($request->user()->roles()->count() === 0 || $request->user()->hasRole(['admin', 'super_admin'])) {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}
