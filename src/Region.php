<?php

namespace Yannickyayo\LaravelApiGeo;

class Region extends LaravelApiGeo
{
    protected string $endpoint = "regions";

    /**
     * Available parameters for searching
     */
    protected array $params = [
        'code',
        'nom',
    ];

    /**
     * Available fields in return
     */
    protected array $fields = [
        'code',
        'nom',
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
