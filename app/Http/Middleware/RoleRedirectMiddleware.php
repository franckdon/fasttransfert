<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Redirections basées sur le rôle
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard');
        }

        if ($user->hasRole('manager')) {
            return redirect()->route('dashboard');
        }

        if ($user->hasRole('user')) {
            return redirect()->route('home');
        }

        // Si aucun rôle ne correspond, continue vers la route demandée
        return $next($request);
    }
}
