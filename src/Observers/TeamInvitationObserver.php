<?php

namespace JeffersonGoncalves\Filament\Teams\Observers;

use Illuminate\Support\Facades\Cache;
use JeffersonGoncalves\Filament\Teams\Models\TeamInvitation;
use Psr\SimpleCache\InvalidArgumentException;

class TeamInvitationObserver
{
    public function created(TeamInvitation $teamInvitation): void
    {
        $this->forgetCount();
    }

    public function deleted(TeamInvitation $teamInvitation): void
    {
        $this->forgetCount();
    }

    protected function forgetCount(): void
    {
        try {
            Cache::delete('team_invitations_count');
        } catch (InvalidArgumentException) {
        }
    }
}
