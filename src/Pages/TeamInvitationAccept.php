<?php

namespace JeffersonGoncalves\Filament\Teams\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
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

    protected string $view = 'filament-teams::pages.team-invitation-accept';

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
            ->recordActions([
                Action::make('accept')
                    ->label(__('filament-teams::teams.invitations.accept.label'))
                    ->icon(Heroicon::Check)
                    ->iconButton()
                    ->requiresConfirmation()
                    ->modalIcon(Heroicon::Check)
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

                        redirect(Filament::getCurrentOrDefaultPanel()->getUrl($record->team));
                    }),
                Action::make('cancel')
                    ->label(__('filament-teams::teams.invitations.cancel.label'))
                    ->color('danger')
                    ->icon(Heroicon::XMark)
                    ->iconButton()
                    ->requiresConfirmation()
                    ->modalIcon(Heroicon::XMark)
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
