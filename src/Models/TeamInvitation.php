<?php

namespace JeffersonGoncalves\Filament\Teams\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\Observers\TeamInvitationObserver;

/**
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Team $team
 */
#[ObservedBy(TeamInvitationObserver::class)]
class TeamInvitation extends Model
{
    protected $fillable = [
        'team_id',
        'email',
    ];

    public function getTable(): string
    {
        return config('filament-teams.tables.team_invitations', 'team_invitations');
    }

    public function accept(Authenticatable $user): void
    {
        $this->team->users()->attach($user->getAuthIdentifier());
        $this->delete();
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(FilamentTeams::teamModel());
    }
}
