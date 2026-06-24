<?php

namespace JeffersonGoncalves\Filament\Teams\Tests\Fixtures;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JeffersonGoncalves\Filament\Teams\Concerns\HasTeamsFilament;

class User extends Authenticatable implements FilamentUser, HasDefaultTenant, HasTenants
{
    use HasTeamsFilament;

    protected $table = 'users';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
