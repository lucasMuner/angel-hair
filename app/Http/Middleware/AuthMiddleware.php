<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = 'auth'): Response
    {
        if ($guard === 'auth' && ! Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        if ($guard === 'guest' && Auth::check()) {
            return redirect()->route('home');
        }

        if ($guard === 'auth') {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->loadMissing('role.modules');
        }

        return $next($request);
    }
}
