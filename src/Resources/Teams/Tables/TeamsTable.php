<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\Teams\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner.name')
                    ->label(__('filament-teams::teams.fields.owner'))
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('filament-teams::teams.fields.name'))
                    ->searchable(),
                IconColumn::make('personal_team')
                    ->label(__('filament-teams::teams.fields.personal_team'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('filament-teams::teams.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament-teams::teams.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
