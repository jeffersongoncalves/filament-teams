<?php

namespace JeffersonGoncalves\Filament\Teams\Concerns;

use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JeffersonGoncalves\Teams\Concerns\HasTeams;

/**
 * Adds Teams multi-tenancy support to the consuming User model for Filament panels.
 *
 * Builds on the framework-agnostic HasTeams trait and implements the Filament
 * HasTenants and HasDefaultTenant contracts. The model should also implement
 * those contracts and provide a `current_team_id` column.
 *
 * @mixin Model
 */
trait HasTeamsFilament
{
    use HasTeams;

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->belongsToTeam($tenant);
    }

    /**
     * @return array<int, Model>|Collection
     */
    public function getTenants(Panel $panel): array|Collection
    {
        return $this->ownedTeams->merge($this->teams)->sortBy('name');
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->currentTeam;
    }
}
