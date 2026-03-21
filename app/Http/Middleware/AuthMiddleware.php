<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = 'auth'): Response
    {
        if ($guard === 'auth') {
            // precisa estar logado
            if (!session('user_id')) {
                 return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
            }
        }

        if ($guard === 'guest') {
            // precisa estar deslogado
            if (session('user_id')) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
