<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\TeamInvitationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use JeffersonGoncalves\Filament\Teams\Resources\TeamInvitationResource;

class ManageTeamInvitations extends ManageRecords
{
    protected static string $resource = TeamInvitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
