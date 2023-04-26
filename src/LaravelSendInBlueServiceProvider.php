<?php

namespace Aon2003\LaravelSendInBlue;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Aon2003\LaravelSendInBlue\Commands\LaravelSendInBlueCommand;

class LaravelSendInBlueServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-sendinblue')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-sendinblue_table')
            ->hasCommand(LaravelSendInBlueCommand::class);
    }
}
