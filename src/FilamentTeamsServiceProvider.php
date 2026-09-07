<?php

namespace JeffersonGoncalves\Filament\Teams;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTeamsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-teams';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews()
            ->hasTranslations();
    }
}
