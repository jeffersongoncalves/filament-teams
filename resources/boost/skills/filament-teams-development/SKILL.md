---
name: filament-teams-development
description: Build and work with Filament Teams multi-tenancy, including the HasTeamsFilament trait, tenancy pages, invitations and admin resources.
---

# Filament Teams Development

## When to use this skill

Use this skill when:
- Adding team-based multi-tenancy to a Filament panel
- Integrating the `HasTeamsFilament` trait into a `User` model
- Customizing the team registration, profile or invitation flows
- Registering the Teams / Team Invitations admin resources

## Configuration

### Basic setup

```php
use JeffersonGoncalves\Filament\Teams\FilamentTeamsPlugin;

FilamentTeamsPlugin::make()
    ->tenancy(true)
    ->invitations(true)
    ->resources(true)
    ->tenantRoutePrefix('team');
```

### User model requirements

The User model must use the trait and implement the Filament tenancy contracts:

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use JeffersonGoncalves\Filament\Teams\Concerns\HasTeamsFilament;

class User extends Authenticatable implements FilamentUser, HasDefaultTenant, HasTenants
{
    use HasTeamsFilament;
}
```

The `users` table requires a nullable `current_team_id` column. Publish and run the package migrations to add it.

## Models

- `Team` — the tenant model (`teams` table).
- `Membership` — pivot model linking users to teams (`membership` table).
- `TeamInvitation` — pending invitations (`team_invitations` table).

The models live in the `jeffersongoncalves/laravel-teams` core package (`JeffersonGoncalves\Teams\Models\*`). All three resolve their table name and related classes from `config/teams.php`, so they can be swapped or renamed.

## Trait API

```php
$user->ownedTeams;          // teams the user owns
$user->teams;               // teams the user is a member of
$user->currentTeam;         // current tenant
$user->personalTeam();      // the auto-created personal team
$user->switchTeam($team);   // switch the active tenant (returns bool)
$user->belongsToTeam($team);
$user->ownsTeam($team);
```

## Troubleshooting

### Plugin not registered

**Cause**: Plugin not added to the PanelProvider.

**Solution**: Add `FilamentTeamsPlugin::make()` to the panel `plugins()` array.

### Tenant cannot be resolved / current_team_id error

**Cause**: The `users` table is missing the `current_team_id` column.

**Solution**: Publish and run the package migrations (`vendor:publish --tag=teams-migrations`).

### Admin resources not visible

**Cause**: Resources are disabled by default.

**Solution**: Call `->resources()` on the plugin instance.
