<?php

namespace JeffersonGoncalves\Filament\Teams\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;

/**
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Team|null $team
 * @property-read Model|null $user
 */
class Membership extends Pivot
{
    public $incrementing = true;

    protected $fillable = [
        'team_id',
        'user_id',
    ];

    public function getTable(): string
    {
        return config('filament-teams.tables.memberships', 'membership');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(FilamentTeams::teamModel());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(FilamentTeams::userModel());
    }
}
