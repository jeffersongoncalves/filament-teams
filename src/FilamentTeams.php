<?php

namespace JeffersonGoncalves\Filament\Teams;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Filament\Teams\Models\Membership;
use JeffersonGoncalves\Filament\Teams\Models\Team;
use JeffersonGoncalves\Filament\Teams\Models\TeamInvitation;

class FilamentTeams
{
    /**
     * @return class-string<Team>
     */
    public static function teamModel(): string
    {
        return config('filament-teams.models.team', Team::class);
    }

    /**
     * @return class-string<TeamInvitation>
     */
    public static function teamInvitationModel(): string
    {
        return config('filament-teams.models.team_invitation', TeamInvitation::class);
    }

    /**
     * @return class-string<Membership>
     */
    public static function membershipModel(): string
    {
        return config('filament-teams.models.membership', Membership::class);
    }

    /**
     * @return class-string<Model>
     */
    public static function userModel(): string
    {
        return config('filament-teams.user_model', 'App\\Models\\User');
    }

    public static function guard(): string
    {
        return config('filament-teams.guard', 'web');
    }

    public static function newTeamModel(): Team
    {
        $class = static::teamModel();

        return new $class;
    }
}
