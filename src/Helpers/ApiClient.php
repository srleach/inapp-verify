<?php

namespace Srleach\InappVerify\Helpers;

/**
 * API Client Class.
 *
 * A client class to wrap an APIClient class - probably GuzzleHttp\Client
 *
 * @package Srleach\InappVerify\Helpers
 */
class ApiClient
{
    private $baseUrl;

    /**
     * Construct the Base API Client.
     *
     * @param string $baseUrl The base URL of the service we're connecting to.
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Make a POST Request to the given component path.
     *
     * @param string $path The path to append to the base url. Omit the leading /
     * @param array $params An array of POST params to send with the request.
     */
    public function post($path, array $params)
    {
//        $uri = $this->baseUrl . '/' . $path;
//        return $this->httpClient->post('POST', $uri, ['json' => $params]);
    }
}