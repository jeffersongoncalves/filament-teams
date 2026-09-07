<?php

use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\FilamentTeamsServiceProvider;
use JeffersonGoncalves\Filament\Teams\Models\Membership;
use JeffersonGoncalves\Filament\Teams\Models\Team;
use JeffersonGoncalves\Filament\Teams\Models\TeamInvitation;

it('registers the service provider', function () {
    expect(app()->getProviders(FilamentTeamsServiceProvider::class))->not->toBeEmpty();
});

it('loads the package configuration', function () {
    expect(config('filament-teams.guard'))->toBe('web')
        ->and(config('filament-teams.tables.teams'))->toBe('teams');
});

it('resolves the configured models', function () {
    expect(FilamentTeams::teamModel())->toBe(Team::class)
        ->and(FilamentTeams::teamInvitationModel())->toBe(TeamInvitation::class)
        ->and(FilamentTeams::membershipModel())->toBe(Membership::class);
});
