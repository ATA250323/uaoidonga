<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // ✅ AJOUTER
use App\Models\User;

class LastUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        /** @var User|null $user */
        $user = Auth::user(); // peut être null si personne n'est connecté

       if ($user) {
            // if (
            //     !$user->last_activity ||
            //     now()->diffInSeconds(\Carbon\Carbon::parse($user->last_activity)) >= 10
            // ) {
                $user->last_activity = now();
                $user->save();
            // }
        }

        return $next($request);
    }
}
