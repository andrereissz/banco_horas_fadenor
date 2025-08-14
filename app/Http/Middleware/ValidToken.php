<?php

namespace App\Http\Middleware;

use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isNull;

class ValidToken
{
    public function __construct(protected BolsaServiceInterface $bolsaService) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('bolsa_token');

        if ($token == null || $this->bolsaService->findBolsaByToken($request->route('bolsa_token')) == null) {
            flash()->error('Solicitação de bolsa inexistente.');
            return redirect()->route('bolsistas.login');
        }

        if(!$this->bolsaService->checkToken($this->bolsaService->findBolsaByToken($request->route('bolsa_token')))) {
            flash()->error('Solicitação de bolsa expirada.');
            return redirect()->route('bolsistas.login');
        }

        $request->attributes->set('bolsa_token', $token);

        return $next($request);
    }
}
