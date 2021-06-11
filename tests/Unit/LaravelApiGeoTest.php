<?php

use Illuminate\Support\Facades\Http;
use Yannickyayo\LaravelApiGeo\Department;
use Yannickyayo\LaravelApiGeo\Exceptions\InvalidParams;
use Yannickyayo\LaravelApiGeo\LaravelApiGeo;
use Yannickyayo\LaravelApiGeo\Region;
use Yannickyayo\LaravelApiGeo\Town;

beforeEach(function () {
    Http::fake(function ($request) {
        $endpoint = explode('/', $request->url());
        $endpoint = explode('?', $endpoint[count($endpoint) - 1])[0];

        if ($endpoint == 'communes') {
            return Http::response(getTownData(), 200);
        }

        if ($endpoint == 'departements') {
            return Http::response(getDepartmentData(), 200);
        }

        if ($endpoint == 'regions') {
            return Http::response(getRegionData(), 200);
        }

        return Http::response('Hello World', 200);
    });
});

it('can construct the Town class', function () {
    expect((new LaravelApiGeo())->towns())->toBeInstanceOf(Town::class);
});

it('can construct the Department class', function () {
    expect((new LaravelApiGeo())->departments())->toBeInstanceOf(Department::class);
});

it('can construct the Region class', function () {
    expect((new LaravelApiGeo())->regions())->toBeInstanceOf(Region::class);
});

it('can call the communes endpoint', function () {
    expect((new LaravelApiGeo())->towns()->getEndpoint())->toBe('communes');
});

it('can call the departements endpoint', function () {
    expect((new LaravelApiGeo())->departments()->getEndpoint())->toBe('departements');
});

it('can call the regions endpoint', function () {
    expect((new LaravelApiGeo())->regions()->getEndpoint())->toBe('regions');
});

it('can specify fields to be retrived when calling the communes endpoint', function () {
    $api = (new LaravelApiGeo())->towns()->fields([
        'code',
        'codeDepartement',
        'codeRegion',
        'nom',
        'codesPostaux',
        'surface',
        'population',
        'centre',
        'contour',
        'departement',
        'region',
    ]);

    expect($api->getFields())->toMatchArray([
        'code',
        'codeDepartement',
        'codeRegion',
        'nom',
        'codesPostaux',
        'surface',
        'population',
        'centre',
        'contour',
        'departement',
        'region',
    ]);
});

it('don\'t add fields not available when calling the communes endpoint', function () {
    $api = (new LaravelApiGeo())->towns()->fields([
        'code',
        'test',
    ]);

    expect($api->getFields())->toMatchArray([
        'code',
    ]);
});

it('can specify fields to be retrived when calling the departements endpoint', function () {
    $api = (new LaravelApiGeo())->departments()->fields([
        'nom',
        'code',
        'codeRegion',
        'region',
    ]);

    expect($api->getFields())->toMatchArray([
        'nom',
        'code',
        'codeRegion',
        'region',
    ]);
});

it('don\'t add fields not available when calling the departements endpoint', function () {
    $api = (new LaravelApiGeo())->departments()->fields([
        'nom',
        'test',
    ]);

    expect($api->getFields())->toMatchArray([
        'nom',
    ]);
});

it('can specify fields to be retrived when calling the regions endpoint', function () {
    $api = (new LaravelApiGeo())->regions()->fields([
        'code',
        'nom',
    ]);

    expect($api->getFields())->toMatchArray([
        'code',
        'nom',
    ]);
});

it('don\'t add fields not available when calling the regions endpoint', function () {
    $api = (new LaravelApiGeo())->regions()->fields([
        'code',
        'test',
    ]);

    expect($api->getFields())->toMatchArray([
        'code',
    ]);
});

it('can search with a key => value pair', function () {
    $api = (new LaravelApiGeo())->towns()->search('nom', 'Pau');

    expect($api['status_code'])->toBe(200);
});

it('throw an exception if searching with wrong parameter', function () {
    (new LaravelApiGeo())->towns()->search('test', 'Pau');
})->throws(InvalidParams::class, 'Wrong parameter. You can\'t search by "test".');

it('throw an exception if searching with no parameter', function () {
    (new LaravelApiGeo())->towns()->search();
})->throws(InvalidParams::class, 'You need a key and a value paramters to search through the geo api.');
