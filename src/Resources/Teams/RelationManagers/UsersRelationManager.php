<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\Teams\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use JeffersonGoncalves\Filament\Teams\Models\Team;

/**
 * @property Team $ownerRecord
 */
class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament-teams::teams.fields.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament-teams::teams.fields.email'))
                    ->searchable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->where('users.id', '!=', $this->ownerRecord->user_id))
                    ->preloadRecordSelect(),
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
