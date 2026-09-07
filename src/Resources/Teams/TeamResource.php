<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\Teams;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\Models\Team;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Pages\CreateTeam;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Pages\EditTeam;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Pages\ListTeams;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Pages\ViewTeam;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\RelationManagers\UsersRelationManager;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Schemas\TeamForm;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Schemas\TeamInfolist;
use JeffersonGoncalves\Filament\Teams\Resources\Teams\Tables\TeamsTable;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

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
        return (string) Cache::rememberForever('teams_count', fn () => FilamentTeams::teamModel()::query()->count());
    }

    public static function form(Schema $schema): Schema
    {
        return TeamForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TeamInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeamsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'view' => ViewTeam::route('/{record}'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}
