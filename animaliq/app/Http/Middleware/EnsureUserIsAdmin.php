<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (! $request->user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        $user = $request->user();

        // Super_admin: full access; share all sections for sidebar
        if ($user->isSuperAdmin()) {
            View::share('adminAllowedSections', $user->allowedAdminSections());
            return $next($request);
        }

        // Admin: must be in at least one department with admin_sections
        $allowed = $user->allowedAdminSections();
        if (empty($allowed)) {
            abort(403, 'You must be assigned to a department with admin access. Ask a super admin to add you to a department and set its admin sections.');
        }

        View::share('adminAllowedSections', $allowed);

        $section = $this->sectionForRoute($request->route()?->getName());
        if ($section !== null && ! in_array($section, $allowed, true)) {
            // Dashboard is always allowed for any admin who has at least one section
            if ($section !== 'dashboard') {
                abort(403, 'You do not have permission to access this section.');
            }
        }

        return $next($request);
    }

    private function sectionForRoute(?string $routeName): ?string
    {
        if ($routeName === null) {
            return null;
        }
        $map = config('admin_sections.route_to_section', []);
        $matched = null;
        $longest = 0;
        foreach ($map as $prefix => $section) {
            if (str_starts_with($routeName, $prefix) && strlen($prefix) > $longest) {
                $longest = strlen($prefix);
                $matched = $section;
            }
        }
        return $matched;
    }
}
