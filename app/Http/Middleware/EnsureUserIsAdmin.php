<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || $request->user()->role !== \App\Enums\UserRole::ADMIN) {
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}
