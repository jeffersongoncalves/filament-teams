<?php

namespace JeffersonGoncalves\Filament\Teams\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\Observers\TeamObserver;
use JeffersonGoncalves\Filament\Teams\Policies\TeamPolicy;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, TeamInvitation> $teamInvitations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Model> $users
 */
#[ObservedBy(TeamObserver::class)]
#[UsePolicy(TeamPolicy::class)]
class Team extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'personal_team',
    ];

    public function getTable(): string
    {
        return config('filament-teams.tables.teams', 'teams');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(FilamentTeams::userModel(), 'user_id');
    }

    public function hasUser($user): bool
    {
        return $this->users->contains($user) || $user->ownsTeam($this);
    }

    public function hasUserWithEmail(string $email): bool
    {
        return $this->allUsers()->contains(fn ($user): bool => $user->email === $email);
    }

    public function allUsers(): Collection
    {
        return $this->users->merge([$this->owner]);
    }

    public function teamInvitations(): HasMany
    {
        return $this->hasMany(FilamentTeams::teamInvitationModel());
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(FilamentTeams::userModel(), FilamentTeams::membershipModel())
            ->withTimestamps()
            ->as('membership');
    }

    public function removeUser($user): void
    {
        if ($user->current_team_id === $this->id) {
            $user->forceFill(['current_team_id' => null])->save();
        }

        $this->users()->detach($user);
    }

    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
        ];
    }
}
