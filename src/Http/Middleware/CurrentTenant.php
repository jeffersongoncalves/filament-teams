<?php

namespace JeffersonGoncalves\Filament\Teams\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use JeffersonGoncalves\Teams\Teams;
use Symfony\Component\HttpFoundation\Response;

class CurrentTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth(Teams::guard())->user();
        $tenant = Filament::getTenant();

        if ($user instanceof Model && $tenant instanceof Model && $tenant->getKey()) {
            if ($user->getAttribute('current_team_id') !== $tenant->getKey()) {
                $user->forceFill(['current_team_id' => $tenant->getKey()])->save();
            }
        }

        return $next($request);
    }
}
