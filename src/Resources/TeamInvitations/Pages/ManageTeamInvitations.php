<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\TeamInvitations\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use JeffersonGoncalves\Filament\Teams\Resources\TeamInvitations\TeamInvitationResource;

class ManageTeamInvitations extends ManageRecords
{
    protected static string $resource = TeamInvitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
