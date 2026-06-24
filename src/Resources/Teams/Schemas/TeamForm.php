<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\Teams\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('filament-teams::teams.fields.owner'))
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('name')
                    ->label(__('filament-teams::teams.fields.name'))
                    ->required(),
            ]);
    }
}
