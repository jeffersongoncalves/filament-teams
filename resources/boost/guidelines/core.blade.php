## Filament Teams

This Filament plugin adds multi-tenancy with Teams, memberships and team invitations to your panels. It builds on the framework-agnostic `jeffersongoncalves/laravel-teams` core (models, migrations, policy, `HasTeams` trait).

### Installation

@verbatim
<code-snippet name="Install the plugin" lang="bash">
composer require jeffersongoncalves/filament-teams
</code-snippet>
@endverbatim

### Prepare the User model

@verbatim
<code-snippet name="Add the HasTeamsFilament trait" lang="php">
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use JeffersonGoncalves\Filament\Teams\Concerns\HasTeamsFilament;

class User extends Authenticatable implements FilamentUser, HasDefaultTenant, HasTenants
{
    use HasTeamsFilament;
}
</code-snippet>
@endverbatim

### Register in PanelProvider

@verbatim
<code-snippet name="Register in PanelProvider" lang="php">
use JeffersonGoncalves\Filament\Teams\FilamentTeamsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentTeamsPlugin::make()
                ->resources(),
        ]);
}
</code-snippet>
@endverbatim

### Available components

- **HasTeamsFilament trait**: builds on the core `HasTeams` trait (`ownedTeams`, `teams`, `currentTeam`, `switchTeam`, `belongsToTeam`, `ownsTeam`, `personalTeam`) and adds the Filament tenancy contract methods (`getTenants`, `getDefaultTenant`, `canAccessTenant`) to the User model.
- **RegisterTeam / EditTeamProfile**: tenant registration and tenant profile pages.
- **TeamInvitationAccept**: page where users accept or decline invitations.
- **TeamResource / TeamInvitationResource**: optional admin resources.

### Best practices

- Always add a `current_team_id` column to your `users` table (publish the migrations).
- Configure the guard, models and table names through the published config file.
- Use the plugin fluent methods (`tenancy()`, `invitations()`, `resources()`, `tenantRoutePrefix()`) to tune behaviour per panel.
