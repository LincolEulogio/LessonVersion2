<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario no ha elegido manualmente un idioma, forzamos el de la configuración (ES)
        // Esto soluciona que sesiones antiguas sigan en inglés por defecto.
        if (!session()->has('locale_manually_set')) {
            session()->put('locale', config('app.locale', 'es'));
        }

        App::setLocale(session()->get('locale', 'es'));

        return $next($request);
    }
}
