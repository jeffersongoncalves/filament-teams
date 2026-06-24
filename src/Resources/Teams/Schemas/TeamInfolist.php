<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\Teams\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('owner.name')
                            ->label(__('filament-teams::teams.fields.owner')),
                        TextEntry::make('name')
                            ->label(__('filament-teams::teams.fields.name')),
                        IconEntry::make('personal_team')
                            ->label(__('filament-teams::teams.fields.personal_team'))
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->label(__('filament-teams::teams.fields.created_at'))
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label(__('filament-teams::teams.fields.updated_at'))
                            ->dateTime(),
                    ]),
            ]);
    }
}
