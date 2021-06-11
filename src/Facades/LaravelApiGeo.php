<?php

namespace Yannickyayo\LaravelApiGeo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Yannickyayo\LaravelApiGeo\LaravelApiGeo
 */
class LaravelApiGeo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-api-geo';
    }
}
