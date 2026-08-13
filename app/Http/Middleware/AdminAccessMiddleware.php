<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();

        if (! $user) {
            abort(403, 'Unauthorized access.');
        }

        $uri = $request->path();

        if (str_contains($uri, '/admin/users') && ! $user->hasRole('superadmin')) {
            abort(403, 'Hanya role superadmin yang dapat mengakses halaman pengguna admin.');
        }

        if (! $user->hasAnyRole(['superadmin', 'editor'])) {
            abort(403, 'Akses ditolak untuk role ini.');
        }

        return $next($request);
    }
}
