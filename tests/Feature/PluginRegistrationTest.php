<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\Filament\Teams\FilamentTeamsPlugin;
use JeffersonGoncalves\Filament\Teams\Pages\TeamInvitationAccept;
use JeffersonGoncalves\Filament\Teams\Resources\TeamInvitations\TeamInvitationResource;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\TeamResource;
use JeffersonGoncalves\Teams\Models\Team;

it('has the expected plugin id', function () {
    expect(FilamentTeamsPlugin::make()->getId())->toBe('filament-teams');
});

it('registers the plugin on the panel', function () {
    $panel = Filament::getPanel('app');

    expect($panel->hasPlugin('filament-teams'))->toBeTrue();
});

it('enables tenancy on the panel', function () {
    $panel = Filament::getPanel('app');

    expect($panel->getTenantModel())->toBe(Team::class)
        ->and($panel->hasTenancy())->toBeTrue();
});

it('registers the invitation acceptance page', function () {
    $panel = Filament::getPanel('app');

    expect($panel->getPages())->toContain(TeamInvitationAccept::class);
});

it('registers the admin resources when enabled', function () {
    $panel = Filament::getPanel('app');

    expect($panel->getResources())
        ->toContain(TeamResource::class)
        ->toContain(TeamInvitationResource::class);
});

it('exposes fluent configuration methods', function () {
    $plugin = FilamentTeamsPlugin::make()
        ->tenancy(false)
        ->invitations(false)
        ->resources(false);

    expect($plugin->hasTenancy())->toBeFalse()
        ->and($plugin->hasInvitations())->toBeFalse()
        ->and($plugin->hasResources())->toBeFalse();
});
