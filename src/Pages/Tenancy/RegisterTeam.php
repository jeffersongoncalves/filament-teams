<?php

namespace JeffersonGoncalves\Filament\Teams\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Filament\Teams\FilamentTeams;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return __('filament-teams::teams.tenancy.register.label');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('filament-teams::teams.fields.name'))
                    ->required(),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        return FilamentTeams::teamModel()::create([
            'name' => $data['name'],
            'user_id' => auth(FilamentTeams::guard())->id(),
            'personal_team' => false,
        ]);
    }
}
