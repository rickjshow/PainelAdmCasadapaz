<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Use o facade Auth para maior compatibilidade com o Intelephense
        if (Auth::check() && Auth::user()->type === 'admin') {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Acesso negado!');
    }
}
