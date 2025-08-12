<?php

namespace App\Http\Middleware;

use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        if ($request->session('token') == null || $this->bolsaService->checkToken($this->bolsaService->findBolsaByToken($request->session('token')->value)) == false) {
            return redirect()->route('bolsistas.login');
        }

        return $next($request);
    }
}
