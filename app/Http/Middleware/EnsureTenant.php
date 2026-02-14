<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!$user->tenant_id) {
            return response()->json(['message' => 'User has no tenant'], 403);
        }

        // Carrega o tenant (evita N+1 e deixa pronto)
        $user->loadMissing('tenant');

        // Opcional: disponibiliza de forma direta na request
        $request->attributes->set('tenant', $user->tenant);

        return $next($request);
    }
}
