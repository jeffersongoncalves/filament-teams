<?php

namespace JeffersonGoncalves\Filament\Teams\Resources\TeamInvitations;

use BackedEnum;
use Closure;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;
use JeffersonGoncalves\Filament\Teams\Resources\TeamInvitations\Pages\ManageTeamInvitations;
use JeffersonGoncalves\Teams\Models\TeamInvitation;
use JeffersonGoncalves\Teams\Teams;

class TeamInvitationResource extends Resource
{
    protected static ?string $model = TeamInvitation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Ticket;

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
        return (string) Cache::rememberForever('team_invitations_count', fn () => Teams::teamInvitationModel()::query()->count());
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('team_id')
                    ->label(__('filament-teams::teams.fields.team'))
                    ->relationship('team', 'name')
                    ->searchable()
                    ->live(onBlur: true)
                    ->required(),
                TextInput::make('email')
                    ->label(__('filament-teams::teams.fields.email'))
                    ->email()
                    ->unique(
                        config('teams.tables.team_invitations', 'team_invitations'),
                        'email',
                        modifyRuleUsing: fn ($rule, Get $get) => $rule->where('team_id', $get('team_id')),
                    )
                    ->required()
                    ->rules([fn (Get $get): Closure => function (string $attribute, mixed $value, Closure $fail) use ($get): void {
                        $team = Teams::teamModel()::find($get('team_id'));

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

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('team.name')
                            ->label(__('filament-teams::teams.fields.team')),
                        TextEntry::make('email')
                            ->label(__('filament-teams::teams.fields.email')),
                        TextEntry::make('created_at')
                            ->label(__('filament-teams::teams.fields.created_at'))
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label(__('filament-teams::teams.fields.updated_at'))
                            ->dateTime(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                TextColumn::make('team.name')
                    ->label(__('filament-teams::teams.fields.team'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament-teams::teams.fields.email'))
                    ->searchable(),
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
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTeamInvitations::route('/'),
        ];
    }
}
