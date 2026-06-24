<?php

namespace JeffersonGoncalves\Filament\Teams;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\Filament\Teams\Http\Middleware\ApplyTenantScopes;
use JeffersonGoncalves\Filament\Teams\Http\Middleware\CurrentTenant;
use JeffersonGoncalves\Filament\Teams\Pages\TeamInvitationAccept;
use JeffersonGoncalves\Filament\Teams\Pages\Tenancy\EditTeamProfile;
use JeffersonGoncalves\Filament\Teams\Pages\Tenancy\RegisterTeam;
use JeffersonGoncalves\Filament\Teams\Resources\TeamInvitations\TeamInvitationResource;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\TeamResource;
use JeffersonGoncalves\Teams\Teams;

class FilamentTeamsPlugin implements Plugin
{
    protected bool $hasTenancy = true;

    protected bool $hasInvitations = true;

    protected bool $hasResources = false;

    protected bool $isPersistentTenant = true;

    protected ?string $tenantRoutePrefix = 'team';

    public function getId(): string
    {
        return 'filament-teams';
    }

    public function register(Panel $panel): void
    {
        if ($this->hasInvitations) {
            $panel->pages([
                TeamInvitationAccept::class,
            ]);
        }

        if ($this->hasResources) {
            $panel->resources([
                TeamResource::class,
                TeamInvitationResource::class,
            ]);
        }

        if ($this->hasTenancy) {
            $panel
                ->tenant(Teams::teamModel())
                ->tenantRegistration(RegisterTeam::class)
                ->tenantProfile(EditTeamProfile::class)
                ->tenantMiddleware([
                    ApplyTenantScopes::class,
                    CurrentTenant::class,
                ], isPersistent: $this->isPersistentTenant);

            if (filled($this->tenantRoutePrefix)) {
                $panel->tenantRoutePrefix($this->tenantRoutePrefix);
            }
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function tenancy(bool $condition = true): static
    {
        $this->hasTenancy = $condition;

        return $this;
    }

    public function invitations(bool $condition = true): static
    {
        $this->hasInvitations = $condition;

        return $this;
    }

    public function resources(bool $condition = true): static
    {
        $this->hasResources = $condition;

        return $this;
    }

    public function persistentTenant(bool $condition = true): static
    {
        $this->isPersistentTenant = $condition;

        return $this;
    }

    public function tenantRoutePrefix(?string $prefix): static
    {
        $this->tenantRoutePrefix = $prefix;

        return $this;
    }

    public function hasResources(): bool
    {
        return $this->hasResources;
    }

    public function hasTenancy(): bool
    {
        return $this->hasTenancy;
    }

    public function hasInvitations(): bool
    {
        return $this->hasInvitations;
    }
}
