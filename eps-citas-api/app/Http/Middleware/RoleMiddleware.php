<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array($request->user()->rol, $roles)) {
            return response()->json(['error' => 'No tienes permisos'], 403);
        }

        return $next($request);
    }
}