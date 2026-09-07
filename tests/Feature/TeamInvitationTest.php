<?php

use JeffersonGoncalves\Filament\Teams\Models\Team;
use JeffersonGoncalves\Filament\Teams\Models\TeamInvitation;
use JeffersonGoncalves\Filament\Teams\Tests\Fixtures\User;

it('accepts an invitation, attaches the user and deletes the invitation', function () {
    $owner = User::create([
        'name' => 'Owner',
        'email' => 'owner@example.com',
        'password' => 'password',
    ]);

    $invited = User::create([
        'name' => 'Invited',
        'email' => 'invited@example.com',
        'password' => 'password',
    ]);

    $team = Team::create([
        'user_id' => $owner->id,
        'name' => 'Engineering',
        'personal_team' => false,
    ]);

    $invitation = TeamInvitation::create([
        'team_id' => $team->id,
        'email' => $invited->email,
    ]);

    $invitation->accept($invited);

    expect($team->users()->whereKey($invited->id)->exists())->toBeTrue()
        ->and(TeamInvitation::query()->count())->toBe(0);
});

it('relates an invitation to its team', function () {
    $owner = User::create([
        'name' => 'Owner',
        'email' => 'owner@example.com',
        'password' => 'password',
    ]);

    $team = Team::create([
        'user_id' => $owner->id,
        'name' => 'Engineering',
        'personal_team' => false,
    ]);

    $invitation = TeamInvitation::create([
        'team_id' => $team->id,
        'email' => 'invited@example.com',
    ]);

    expect($invitation->team->is($team))->toBeTrue();
});
