<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;

class ResolveTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = strtolower($request->getHost()); // ex: anaestetica.seuapp.com.br

        // 1) Primeiro tenta por domínio customizado
        $tenant = Tenant::where('custom_domain', $host)->first();

        // 2) Se não achou, tenta extrair o subdomínio (slug)
        if (!$tenant) {
            // Ajuste aqui para o seu domínio base quando você tiver (ex: agendapro.com.br)
            $baseDomain = config('app.base_domain'); // ex: agendapro.com.br

            if ($baseDomain && str_ends_with($host, $baseDomain)) {
                // remove ".agendapro.com.br"
                $sub = str_replace('.' . $baseDomain, '', $host);

                // só aceita se tiver algo antes do domínio base (um subdomínio)
                if ($sub !== $host && $sub !== '') {
                    $tenant = Tenant::where('slug', $sub)->first();
                }
            }
        }

        // Se não encontrou tenant, deixa seguir (por enquanto)
        // Mais pra frente, a gente pode bloquear tudo exceto rotas públicas.
        if ($tenant) {
            app()->instance('tenant', $tenant);

            // Se estiver suspenso, bloqueia rotas privadas (vamos evoluir isso já já)
            if ($tenant->status === 'suspended') {
                return response()->json([
                    'message' => 'Plano suspenso. Regularize o pagamento para continuar.',
                ], 402);
            }
        }

        return $next($request);
    }
}

