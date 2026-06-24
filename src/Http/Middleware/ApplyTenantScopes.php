<?php

namespace JeffersonGoncalves\Filament\Teams\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyTenantScopes
{
    /**
     * Handle an incoming request.
     *
     * Add global scopes here to restrict your own models to the current tenant,
     * for example:
     *
     *     Post::addGlobalScope(
     *         fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
     *     );
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
