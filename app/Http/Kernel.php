<?php

namespace App\Http;

use App\Http\Middleware\AuthEnseignant;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\RedirectIfEnseignantAuthenticated;

class Kernel extends HttpKernel
{
    /**
     * Middleware globaux exécutés sur chaque requête.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Middleware globaux Laravel standard...
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // \App\Http\Middleware\DetectUserGuard::class,
    ];

    /**
     * Groupes de middleware.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            \App\Http\Middleware\SetLocale::class, // Ton middleware perso pour la langue
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware nommés utilisables dans les routes.
     *
     * @var array<string, class-string|string>
     */
 
}
