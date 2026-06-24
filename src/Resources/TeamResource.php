<?php

namespace JeffersonGoncalves\Filament\Teams\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;
use JeffersonGoncalves\Filament\Teams\Resources\TeamResource\Pages;
use JeffersonGoncalves\Filament\Teams\Resources\TeamResource\RelationManagers;
use JeffersonGoncalves\Teams\Models\Team;
use JeffersonGoncalves\Teams\Teams;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return __('filament-teams::teams.team.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-teams::teams.team.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-teams::teams.team.navigation_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-teams::teams.navigation_group');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Cache::rememberForever('teams_count', fn () => Teams::teamModel()::query()->count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label(__('filament-teams::teams.fields.owner'))
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament-teams::teams.fields.name'))
                    ->required(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('owner.name')
                            ->label(__('filament-teams::teams.fields.owner')),
                        Infolists\Components\TextEntry::make('name')
                            ->label(__('filament-teams::teams.fields.name')),
                        Infolists\Components\IconEntry::make('personal_team')
                            ->label(__('filament-teams::teams.fields.personal_team'))
                            ->boolean(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label(__('filament-teams::teams.fields.created_at'))
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label(__('filament-teams::teams.fields.updated_at'))
                            ->dateTime(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('owner.name')
                    ->label(__('filament-teams::teams.fields.owner'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-teams::teams.fields.name'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('personal_team')
                    ->label(__('filament-teams::teams.fields.personal_team'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-teams::teams.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-teams::teams.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'view' => Pages\ViewTeam::route('/{record}'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
