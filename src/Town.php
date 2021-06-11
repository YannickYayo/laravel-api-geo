<?php

namespace Yannickyayo\LaravelApiGeo;

class Town extends LaravelApiGeo
{
    protected string $endpoint = "communes";

    /**
     * Available parameters for searching
     */
    protected array $params = [
        'codePostal',
        'codeDepartement',
        'codeRegion',
        'nom',
        'lon',
        'lat',
    ];

    /**
     * Available fields in return
     */
    protected array $fields = [
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
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->availableParams = $this->params;
        $this->availableFields = $this->fields;
    }
}
