<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue;

use Aon2003\LaravelSendInBlue\Commands\LaravelSendInBlueCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSendInBlueServiceProvider extends PackageServiceProvider
{
    /**
     * @param Package $package
     * @return void
     */
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
//            ->hasViews()
//            ->hasMigration('create_laravel-sendinblue_table')
            ->hasCommand(LaravelSendInBlueCommand::class);
    }
}
