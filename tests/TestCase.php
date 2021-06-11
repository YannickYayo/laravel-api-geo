<?php

namespace Yannickyayo\LaravelApiGeo\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Yannickyayo\LaravelApiGeo\LaravelApiGeoServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelApiGeoServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_laravel-api-geo_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
