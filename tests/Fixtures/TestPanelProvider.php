<?php

namespace JeffersonGoncalves\Filament\Teams\Tests\Fixtures;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\Teams\FilamentTeamsPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->authGuard('web')
            ->pages([
                Dashboard::class,
            ])
            ->plugin(
                FilamentTeamsPlugin::make()
                    ->resources()
            )
            ->middleware([
                DispatchServingFilamentEvent::class,
                DisableBladeIconComponents::class,
            ]);
    }
}
