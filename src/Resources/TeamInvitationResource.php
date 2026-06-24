<?php

namespace JeffersonGoncalves\Filament\Teams\Resources;

use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\Models\TeamInvitation;
use JeffersonGoncalves\Filament\Teams\Resources\TeamInvitationResource\Pages;

class TeamInvitationResource extends Resource
{
    protected static ?string $model = TeamInvitation::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $recordTitleAttribute = 'email';

    public static function getModelLabel(): string
    {
        return __('filament-teams::teams.invitation.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-teams::teams.invitation.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-teams::teams.invitation.navigation_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-teams::teams.navigation_group');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Cache::rememberForever('team_invitations_count', fn () => FilamentTeams::teamInvitationModel()::query()->count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->label(__('filament-teams::teams.fields.team'))
                    ->relationship('team', 'name')
                    ->searchable()
                    ->live(onBlur: true)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('filament-teams::teams.fields.email'))
                    ->email()
                    ->unique(
                        config('filament-teams.tables.team_invitations', 'team_invitations'),
                        'email',
                        modifyRuleUsing: fn ($rule, Forms\Get $get) => $rule->where('team_id', $get('team_id')),
                    )
                    ->required()
                    ->rules([fn (Forms\Get $get): Closure => function (string $attribute, mixed $value, Closure $fail) use ($get): void {
                        $team = FilamentTeams::teamModel()::find($get('team_id'));

                        if (! $team) {
                            return;
                        }

                        if ($team->users()->where('email', $value)->exists()) {
                            $fail(__('filament-teams::teams.validation.email_taken'));
                        }

                        if ($team->owner()->where('email', $value)->exists()) {
                            $fail(__('filament-teams::teams.validation.email_taken'));
                        }
                    }]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('team.name')
                            ->label(__('filament-teams::teams.fields.team')),
                        Infolists\Components\TextEntry::make('email')
                            ->label(__('filament-teams::teams.fields.email')),
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
                Tables\Columns\TextColumn::make('team.name')
                    ->label(__('filament-teams::teams.fields.team'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament-teams::teams.fields.email'))
                    ->searchable(),
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
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTeamInvitations::route('/'),
        ];
    }
}
