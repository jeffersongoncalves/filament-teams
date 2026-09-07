<?php

namespace JeffersonGoncalves\Filament\Teams\Concerns;

use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\Models\Team;

/**
 * Adds Teams multi-tenancy support to the consuming User model.
 *
 * The model should also implement the Filament HasTenants and HasDefaultTenant
 * contracts and provide a `current_team_id` column.
 *
 * @property int|null $current_team_id
 * @property-read Team|null $currentTeam
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Team> $ownedTeams
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Team> $teams
 *
 * @mixin Model
 */
trait HasTeams
{
    public static function bootHasTeams(): void
    {
        static::created(function (Model $user): void {
            if (! config('filament-teams.personal_teams', true)) {
                return;
            }

            $name = explode(' ', (string) $user->getAttribute('name'), 2)[0];

            FilamentTeams::teamModel()::forceCreate([
                'user_id' => $user->getKey(),
                'name' => $name."'s Team",
                'personal_team' => true,
            ]);
        });
    }

    public function ownedTeams(): HasMany
    {
        return $this->hasMany(FilamentTeams::teamModel());
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(FilamentTeams::teamModel(), FilamentTeams::membershipModel())
            ->withTimestamps()
            ->as('membership');
    }

    public function currentTeam(): BelongsTo
    {
        if (is_null($this->getAttribute('current_team_id')) && $this->getKey()) {
            $this->switchTeam($this->personalTeam());
        }

        return $this->belongsTo(FilamentTeams::teamModel(), 'current_team_id');
    }

    public function personalTeam(): ?Team
    {
        return $this->ownedTeams->where('personal_team', true)->first();
    }

    public function switchTeam($team): bool
    {
        if (is_null($team) || ! $this->belongsToTeam($team)) {
            return false;
        }

        $this->forceFill([
            'current_team_id' => $team->id,
        ])->save();

        $this->setRelation('currentTeam', $team);

        return true;
    }

    public function belongsToTeam($team): bool
    {
        if (is_null($team)) {
            return false;
        }

        return $this->ownsTeam($team) || $this->teams->contains(fn ($t): bool => $t->id === $team->id);
    }

    public function ownsTeam($team): bool
    {
        if (is_null($team)) {
            return false;
        }

        return $this->getKey() == $team->user_id;
    }

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
