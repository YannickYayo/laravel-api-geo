<?php

namespace Yannickyayo\LaravelApiGeo\Commands;

use Illuminate\Console\Command;

class LaravelApiGeoCommand extends Command
{
    public $signature = 'laravel-api-geo';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
