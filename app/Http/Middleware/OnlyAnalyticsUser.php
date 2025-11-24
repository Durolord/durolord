<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAnalyticsUser
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Must be logged in *and* match the allowed email
        if (! $request->user() || $request->user()->email !== 'noreply@durolord.com') {
            abort(403);
        }

        return $next($request);
    }
}
