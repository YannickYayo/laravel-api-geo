<?php

namespace Yannickyayo\LaravelApiGeo\Exceptions;

use Exception;

class InvalidParams extends Exception
{
    public static function wrongParams(string $param): self
    {
        return new static('Wrong parameter. You can\'t search by "'.$param.'".');
    }

    public static function noParams(): self
    {
        return new static('You need a key and a value paramters to search through the geo api.');
    }
}
