<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Accès non autorisé.');
        }

        if ($role === 'fournisseur' && auth()->user()->status !== 'approved') {
            abort(403, 'Votre compte fournisseur est en attente de validation par l\'administrateur.');
        }

        return $next($request);
    }
}
