<?php

namespace Srleach\InappVerify\Helpers;
use GuzzleHttp\Client;

/**
 * Class AppleApiHelper
 *
 * @package Srleach\InappVerify\Helpers
 */
class AppleApiHelper
{
    protected $api;

    public function __construct(Client $httpClient)
    {
        $api = new ApiClient($httpClient);
    }
}