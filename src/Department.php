<?php

namespace Yannickyayo\LaravelApiGeo;

class Department extends LaravelApiGeo
{
    protected string $endpoint = "departements";

    /**
     * Available parameters for searching
     */
    protected array $params = [
        'code',
        'codeRegion',
        'nom',
    ];

    /**
     * Available fields in return
     */
    protected array $fields = [
        'nom',
        'code',
        'codeRegion',
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
