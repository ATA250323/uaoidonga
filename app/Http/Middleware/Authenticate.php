<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
        /**
     * Détermine où rediriger les utilisateurs non authentifiés.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Exemple : si l’URL contient "eleve", on redirige vers le login élève
            if ($request->is('eleve/*') || $request->is('eleve')) {
                return route('eleve.login'); // Assurez-vous que cette route existe
            }

            // Sinon, redirection par défaut (ex: admin ou web)
            return route('login');
        }

        return null;
    }
    }

