# Wrapper Laravel pour communiquer avec l'API GEO du gouvernement français.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yannickyayo/laravel-api-geo.svg?style=flat-square)](https://packagist.org/packages/yannickyayo/laravel-api-geo)
[![Tests](https://github.com/YannickYayo/laravel-api-geo/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/YannickYayo/laravel-api-geo/actions/workflows/run-tests.yml)
[![Larastan](https://github.com/YannickYayo/laravel-api-geo/actions/workflows/larastan.yml/badge.svg?branch=main)](https://github.com/YannickYayo/laravel-api-geo/actions/workflows/larastan.yml)
[![Style](https://github.com/YannickYayo/laravel-api-geo/actions/workflows/php-cs-fixer.yml/badge.svg?branch=main)](https://github.com/YannickYayo/laravel-api-geo/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/yannickyayo/laravel-api-geo.svg?style=flat-square)](https://packagist.org/packages/yannickyayo/laravel-api-geo)

Ce package Laravel apporte un Wrapper autour de l'[API Geo](https://api.gouv.fr/les-api/api-geo) du gouvernement français.

## Installation

Vous pouvez installer le package via composer :

```bash
composer require yannickyayo/laravel-api-geo
```
## Utilisation

```php
use Yannickyayo\LaravelApiGeo\Facades\LaravelApiGeo;

//---------- Recherches ----------//

// Chercher une commune
$response = LaravelApiGeo::towns()->search('nom', 'Pau');
/*
Clés possible pour la recherche des communes :
[
    'codePostal',
    'codeDepartement',
    'codeRegion',
    'nom',
    'lon',
    'lat',
]
*/

// Chercher un département
$response = LaravelApiGeo::departments()->search('nom', 'Pyrénées-Atlantiques');
/*
Clés possible pour la recherche des départements :
[
    'code',
    'codeRegion',
    'nom',
]
*/

// Chercher une région
$response = LaravelApiGeo::regions()->search('nom', 'Nouvelle-Aquitaine');
/*
Clés possible pour la recherche des régions :
[
    'code',
    'nom',
]
*/

/*
Exemple de résultat :
    [
        "status_code" => 200,
        "data" => "[{"code":"64445","codeDepartement":"64","codeRegion":"75","nom":"Pau","codesPostaux":["64000","64023"],"surface":3149.75,"population":77251,"centre":{"type":"Point","coordinates":[-0.3462,43.3197]},"contour":{"type":"Polygon","coordinates":[[...]]},"_score":0.24253612514094966,"departement":{"code":"64","nom":"Pyrénées-Atlantiques"},"region":{"code":"75","nom":"Nouvelle-Aquitaine"}}]",
    ]

    Vous recevez un tableau contenant de code status de la réponse et les données au format json.
*/
```

## Récupérer seulement certaines colonnes
Il est possible de limiter les colonnes renvoyées par l'API avec la méthode `fields()` :

```php
$response = LaravelApiGeo::towns()->fields(['nom', 'surface'])->search('nom', 'Pau');

/*
Colonnes possibles pour les communes :
[
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
]

Colonnes possibles pour les départements
[
    'nom',
    'code',
    'codeRegion',
    'region',
]

Colonnes possibles pour les régions
[
    'code',
    'nom',
]
*/
```
## Test

```bash
composer test
```

## Changelog

Veuillez vous référer au [CHANGELOG](CHANGELOG.md) pour plus d'informations sur ce qui a changé récemment.

## Contribuer

Veuillez vous référer au fichier [CONTRIBUTING](.github/CONTRIBUTING.md) pour les détails.

## Failles de sécurité

Veuillez vour référer à [notre politique de sécurité](../../security/policy) pour savoir comment faire un rapport de sécurité.

## Credits

- [LEONE Yannick](https://github.com/YannickYayo)
- [Tous les contributeurs](../../contributors)

## License

Licence MIT (MIT). Voir [Licence](LICENSE.md) pour plus d'informations.
