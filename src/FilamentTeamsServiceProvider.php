<?php

namespace JeffersonGoncalves\Filament\Teams;

use Illuminate\Support\Facades\Gate;
use JeffersonGoncalves\Filament\Teams\Policies\TeamPolicy;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTeamsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-teams';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigrations([
                'create_teams_table',
                'create_team_memberships_table',
                'create_team_invitations_table',
                'add_current_team_id_to_users_table',
            ]);
    }

    public function packageBooted(): void
    {
        Gate::policy(FilamentTeams::teamModel(), TeamPolicy::class);
    }
}
