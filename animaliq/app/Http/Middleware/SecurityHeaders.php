<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     * Attach modern security headers to harden the application against attacks.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (method_exists($response, 'header')) {
            // Prevent browsers from MIME-sniffing a response away from the declared content-type
            $response->header('X-Content-Type-Options', 'nosniff');
            
            // Defend against Clickjacking by ensuring only the same origin can iframe the platform
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            
            // Force older browsers to enable their heuristic XSS filtering mechanisms
            $response->header('X-XSS-Protection', '1; mode=block');
            
            // Strict referrer-policy that won't leak URLs cross-origin
            $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
            
            // Permissions policy explicitly disabling obscure hardware/browser APIs globally
            $response->header('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        }

        return $response;
    }
}
