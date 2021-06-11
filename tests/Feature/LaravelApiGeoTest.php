<?php

use Yannickyayo\LaravelApiGeo\LaravelApiGeo;

it('call the communes endpoint and get results', function () {
    $response = (new LaravelApiGeo())->towns()->search('nom', 'Pau');
    sleep(1); // to avoid to much requests to the api
    expect($response)->toBeArray()->and($response['status_code'])->toBe(200);
});

it('call the departments endpoint and get results', function () {
    $response = (new LaravelApiGeo())->departments()->search('nom', 'Pyrénées-Atlantiques');
    sleep(1); // to avoid to much requests to the api
    expect($response)->toBeArray()->and($response['status_code'])->toBe(200);
});

it('call the regions endpoint and get results', function () {
    $response = (new LaravelApiGeo())->regions()->search('nom', 'Nouvelle-Aquitaine');
    sleep(1); // to avoid to much requests to the api
    expect($response)->toBeArray()->and($response['status_code'])->toBe(200);
});
