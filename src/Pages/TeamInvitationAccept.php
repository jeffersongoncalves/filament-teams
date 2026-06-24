<?php

namespace JeffersonGoncalves\Filament\Teams\Pages;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;
use JeffersonGoncalves\Filament\Teams\Models\TeamInvitation;

class TeamInvitationAccept extends Page implements HasTable
{
    use InteractsWithTable;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static string $view = 'filament-teams::pages.team-invitation-accept';

    public static function getNavigationLabel(): string
    {
        return __('filament-teams::teams.invitations.navigation_label');
    }

    public function getTitle(): string
    {
        return __('filament-teams::teams.invitations.title');
    }

    public function table(Table $table): Table
    {
        $user = auth(FilamentTeams::guard())->user();
        $email = $user instanceof Model ? $user->getAttribute('email') : null;

        return $table
            ->recordTitleAttribute('email')
            ->query(
                FilamentTeams::teamInvitationModel()::query()
                    ->where('email', $email)
            )
            ->columns([
                TextColumn::make('team.name')
                    ->label(__('filament-teams::teams.fields.team'))
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
            ->actions([
                Action::make('accept')
                    ->label(__('filament-teams::teams.invitations.accept.label'))
                    ->icon('heroicon-o-check')
                    ->iconButton()
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check')
                    ->modalHeading(__('filament-teams::teams.invitations.accept.heading'))
                    ->action(function (TeamInvitation $record): void {
                        $user = auth(FilamentTeams::guard())->user();

                        if (! $user) {
                            return;
                        }

                        $record->accept($user);

                        Notification::make()
                            ->title(__('filament-teams::teams.invitations.accept.success'))
                            ->success()
                            ->send();

                        $panel = Filament::getCurrentPanel();

                        redirect($panel ? $panel->getUrl($record->team) : Filament::getUrl());
                    }),
                Action::make('cancel')
                    ->label(__('filament-teams::teams.invitations.cancel.label'))
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->iconButton()
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-x-mark')
                    ->modalHeading(__('filament-teams::teams.invitations.cancel.heading'))
                    ->action(function (TeamInvitation $record): void {
                        $record->delete();

                        Notification::make()
                            ->title(__('filament-teams::teams.invitations.cancel.success'))
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
