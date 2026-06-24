<?php

use JeffersonGoncalves\Filament\Teams\Models\Team;
use JeffersonGoncalves\Filament\Teams\Tests\Fixtures\User;

function makeUser(string $name = 'Jefferson Goncalves', string $email = 'jefferson@example.com'): User
{
    return User::create([
        'name' => $name,
        'email' => $email,
        'password' => 'password',
    ]);
}

it('creates a personal team automatically for new users', function () {
    $user = makeUser();

    expect($user->ownedTeams)->toHaveCount(1)
        ->and($user->personalTeam())->not->toBeNull()
        ->and($user->personalTeam()->personal_team)->toBeTrue()
        ->and($user->personalTeam()->name)->toBe("Jefferson's Team");
});

it('does not create a personal team when disabled', function () {
    config()->set('filament-teams.personal_teams', false);

    $user = makeUser(email: 'no-team@example.com');

    expect($user->ownedTeams)->toHaveCount(0);
});

it('knows the teams a user owns and belongs to', function () {
    $owner = makeUser();
    $member = makeUser('Member', 'member@example.com');

    $team = Team::create([
        'user_id' => $owner->id,
        'name' => 'Engineering',
        'personal_team' => false,
    ]);

    $team->users()->attach($member);

    expect($owner->ownsTeam($team))->toBeTrue()
        ->and($member->ownsTeam($team))->toBeFalse()
        ->and($member->belongsToTeam($team))->toBeTrue()
        ->and($team->hasUser($member))->toBeTrue();
});

it('switches the current team only for teams the user belongs to', function () {
    $owner = makeUser();
    $foreign = Team::create([
        'user_id' => makeUser('Other', 'other@example.com')->id,
        'name' => 'Foreign',
        'personal_team' => false,
    ]);

    expect($owner->switchTeam($foreign))->toBeFalse();

    $own = Team::create([
        'user_id' => $owner->id,
        'name' => 'Mine',
        'personal_team' => false,
    ]);

    expect($owner->switchTeam($own))->toBeTrue()
        ->and($owner->fresh()->current_team_id)->toBe($own->id);
});

it('removes a user from a team and clears the current team', function () {
    $owner = makeUser();
    $member = makeUser('Member', 'member@example.com');

    $team = Team::create([
        'user_id' => $owner->id,
        'name' => 'Engineering',
        'personal_team' => false,
    ]);

    $team->users()->attach($member);
    $member->forceFill(['current_team_id' => $team->id])->save();

    $team->removeUser($member);

    expect($team->users()->count())->toBe(0)
        ->and($member->fresh()->current_team_id)->toBeNull();
});
