<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRoleEnum;

class AdminOrAuthor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && in_array($user->role, [UserRoleEnum::Administrator, UserRoleEnum::Author])) {
            return $next($request);
        }

        abort(403, 'Access denied.');
    }
}
