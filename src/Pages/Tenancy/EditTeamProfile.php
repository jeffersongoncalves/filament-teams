<?php

namespace JeffersonGoncalves\Filament\Teams\Pages\Tenancy;

use Closure;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use JeffersonGoncalves\Teams\Models\Team;

/**
 * @property Team $tenant
 */
class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return __('filament-teams::teams.tenancy.profile.label');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('filament-teams::teams.fields.name')),
                Repeater::make('teamInvitations')
                    ->label(__('filament-teams::teams.fields.invitations'))
                    ->relationship('teamInvitations')
                    ->simple(
                        TextInput::make('email')
                            ->label(__('filament-teams::teams.fields.email'))
                            ->unique(
                                config('teams.tables.team_invitations', 'team_invitations'),
                                'email',
                                modifyRuleUsing: fn ($rule) => $rule->where('team_id', $this->tenant->id),
                            )
                            ->rules([fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
                                if ($this->tenant->users()->where('email', $value)->exists()) {
                                    $fail(__('filament-teams::teams.validation.email_taken'));
                                }

                                if ($this->tenant->owner()->where('email', $value)->exists()) {
                                    $fail(__('filament-teams::teams.validation.email_taken'));
                                }
                            }])
                            ->email()
                            ->required(),
                    )
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                        $data['team_id'] = $this->tenant->id;

                        return $data;
                    }),
            ]);
    }
}
