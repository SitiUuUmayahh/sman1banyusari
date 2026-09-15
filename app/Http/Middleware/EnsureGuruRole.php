<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureGuruRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user('guru')?->role !== $role) {
            abort(403, 'Role guru tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
