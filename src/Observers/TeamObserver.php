<?php

namespace JeffersonGoncalves\Filament\Teams\Observers;

use Illuminate\Support\Facades\Cache;
use JeffersonGoncalves\Filament\Teams\Models\Team;
use Psr\SimpleCache\InvalidArgumentException;

class TeamObserver
{
    public function created(Team $team): void
    {
        $this->forgetCount();
    }

    public function deleted(Team $team): void
    {
        $this->forgetCount();
    }

    protected function forgetCount(): void
    {
        try {
            Cache::delete('teams_count');
        } catch (InvalidArgumentException) {
        }
    }
}
