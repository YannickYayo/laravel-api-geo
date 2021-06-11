<?php

namespace Yannickyayo\LaravelApiGeo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Yannickyayo\LaravelApiGeo\Exceptions\InvalidParams;

class LaravelApiGeo
{
    const BASE_URL = "https://geo.api.gouv.fr/";

    protected string $param = '';
    protected string $search = '';
    protected array $fields = [];

    protected array $availableParams = [];
    protected array $availableFields = [];
    protected string $endpoint = '';

    /**
     * Search by town
     */
    public function towns()
    {
        return new Town();
    }

    /**
     * Search by department
     */
    public function departments()
    {
        return new Department();
    }

    /**
     * Search by region
     */
    public function regions()
    {
        return new Region();
    }

    /**
     * Add fields to the json returned by the geo api
     *
     * @param array $fields Fields to add
     *
     * @return self
     */
    public function fields(array $fields): self
    {
        foreach ($fields as $field) {
            if (in_array($field, $this->availableFields)) {
                $this->fields[] = $field;
            }
        }

        return $this;
    }

    /**
     * Search
     *
     * @param string $key Search parameter
     * @param string $value Search value
     *
     * @throws \Yannickyayo\LaravelApiGeo\Exceptions\InvalidParams
     *
     * @return array
     */
    public function search(string $key = '', string $value = ''): array
    {
        if ($key == '' || $value == '') {
            throw InvalidParams::noParams();
        }

        if (in_array($key, $this->availableParams)) {
            $this->param = $key;
            $this->search = $value;
        } else {
            throw InvalidParams::wrongParams($key);
        }

        return $this->run();
    }

    /**
     * Run search
     *
     * @return array Array with status_code ; url ; data
     */
    private function run(): array
    {
        $response = $this->doRequest(self::BASE_URL.$this->endpoint);

        return [
            'status_code' => $response->status(),
            'data' => $response->body(),
        ];
    }

    /**
     * Do a simple request with the HTTP Facade
     *
     * @param string $url URL to query
     *
     * @throws \Illuminate\Http\Client\RequestException
     *
     * @return Response
     */
    private function doRequest(string $url): Response
    {
        return Http::accept('application/json')
            ->timeout(10)
            ->retry(3, 100)
            ->get($url, [
                $this->param => $this->search,
                'fields' => implode(',', $this->fields),
            ])
            ->throw();
    }

    /**
     * Get the value of param
     */
    public function getParam(): string
    {
        return $this->param;
    }

    /**
     * Get the value of search
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * Get the value of fields
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Get the value of availableParams
     */
    public function getAvailableParams(): array
    {
        return $this->availableParams;
    }

    /**
     * Get the value of availableFields
     */
    public function getAvailableFields(): array
    {
        return $this->availableFields;
    }

    /**
     * Get the value of endpoint
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}
