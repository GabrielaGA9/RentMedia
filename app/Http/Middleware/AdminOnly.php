<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            Log::info('Middleware AdminOnly:', [
                'usuario' => auth()->user()->email,
                'rol' => auth()->user()->role,
            ]);
           
            if (auth()->user()->role === 'admin') {
                return $next($request);
            }
        }

        Log::warning('Usuario sin acceso admin detectado.', [
            'usuario' => auth()->user() ? auth()->user()->email : 'no logueado',
        ]);

        return redirect()->route('cliente.inicio')->with('error', 'Acceso no autorizado.');
    }
}
