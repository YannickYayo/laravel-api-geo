<?php

namespace Yannickyayo\LaravelApiGeo;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Yannickyayo\LaravelApiGeo\LaravelApiGeo
 */
class LaravelApiGeoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-api-geo';
    }
}
