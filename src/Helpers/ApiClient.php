<?php

namespace Srleach\InappVerify\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * API Client Class.
 *
 * A client class to wrap an APIClient class - probably GuzzleHttp\Client
 *
 * @package Srleach\InappVerify\Helpers
 */
class ApiClient
{
    private $httpClient;
    private $baseUrl;

    /**
     * Construct the Base API Client.
     *
     * @param Client $httpClient An instance of the HTTP Client (Probably Guzzle)
     * @param string $baseUrl The base URL of the service we're connecting to.
     */
    public function __construct(Client $httpClient, $baseUrl)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Make a POST Request to the given component path.
     *
     * @param string $path The path to append to the base url. Omit the leading /
     * @param array $params An array of POST params to send with the request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($path, array $params)
    {
        $uri = $this->baseUrl . '/' . $path;
        return $this->httpClient->post('POST', $uri, ['json' => $params]);
    }
}