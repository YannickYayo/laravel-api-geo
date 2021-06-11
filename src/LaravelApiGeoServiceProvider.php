<?php

namespace Yannickyayo\LaravelApiGeo;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Yannickyayo\LaravelApiGeo\Commands\LaravelApiGeoCommand;

class LaravelApiGeoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-api-geo')
            ->hasConfigFile()
            ->hasCommand(LaravelApiGeoCommand::class);

        $this->app->bind('laravel-api-geo', function ($app) {
            return new LaravelApiGeo();
        });
    }
}
