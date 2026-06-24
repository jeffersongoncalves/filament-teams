<div class="filament-hidden">

![Filament Teams](https://raw.githubusercontent.com/jeffersongoncalves/filament-teams/2.x/art/jeffersongoncalves-filament-teams.png)

</div>

# Filament Teams

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-teams.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-teams)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-teams/tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-teams/actions?query=workflow%3Atests+branch%3A2.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-teams/fix-php-code-style-issues.yml?branch=2.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-teams/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A2.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-teams.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-teams)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-teams.svg?style=flat-square)](LICENSE.md)

A Filament plugin that adds multi-tenancy with Teams, memberships, and team invitations to your panels. It ships everything you need to turn a single-tenant Filament panel into a team-based, multi-tenant application: a `HasTeams` trait for your `User` model, tenant registration and profile pages, an invitation acceptance flow, and optional admin resources to manage Teams and Team Invitations.

## Features

- 🏢 Multi-tenancy backed by a `Team` model
- 👥 Team memberships through a pivot model
- ✉️ Team invitations with accept / cancel flow
- 🪪 Personal team automatically created for every new user
- 🧩 `HasTeams` trait wiring all tenancy contracts
- 🛠️ Optional admin resources for Teams and Team Invitations
- ⚙️ Publishable configuration and migrations (models, tables and guard are configurable)

## Compatibility

| Plugin Version                                                   | Filament | PHP   | Laravel    |
|-----------------------------------------------------------------|----------|-------|------------|
| [1.x](https://github.com/jeffersongoncalves/filament-teams/tree/1.x) | ^3.0     | ^8.1  | ^10.0      |
| [2.x](https://github.com/jeffersongoncalves/filament-teams/tree/2.x) | ^4.0     | ^8.2  | ^11.0      |
| [3.x](https://github.com/jeffersongoncalves/filament-teams/tree/3.x) | ^5.0     | ^8.3  | ^12.0/^13.0 |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-teams:"^2.0"
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-teams-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-teams-config"
```

## Usage

### 1. Prepare your User model

Add the `HasTeams` trait and implement the Filament tenancy contracts on your `User` model. Your `users` table needs a `current_team_id` column (provided by the published migration).

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JeffersonGoncalves\Filament\Teams\Concerns\HasTeams;

class User extends Authenticatable implements FilamentUser, HasDefaultTenant, HasTenants
{
    use HasTeams;
}
```

### 2. Register the plugin

```php
use JeffersonGoncalves\Filament\Teams\FilamentTeamsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentTeamsPlugin::make()
                ->tenancy()            // enable tenant config (default: true)
                ->invitations()        // register the invitation acceptance page (default: true)
                ->resources()          // register the Teams & Team Invitations admin resources (default: false)
                ->tenantRoutePrefix('team'),
        ]);
}
```

The plugin will automatically configure the panel tenant model, tenant registration page, tenant profile page, and the tenant middleware.

## Configuration

```php
return [
    'guard' => 'web',
    'user_model' => 'App\\Models\\User',
    'personal_teams' => true,
    'models' => [
        'team' => \JeffersonGoncalves\Filament\Teams\Models\Team::class,
        'team_invitation' => \JeffersonGoncalves\Filament\Teams\Models\TeamInvitation::class,
        'membership' => \JeffersonGoncalves\Filament\Teams\Models\Membership::class,
    ],
    'tables' => [
        'teams' => 'teams',
        'memberships' => 'membership',
        'team_invitations' => 'team_invitations',
    ],
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
