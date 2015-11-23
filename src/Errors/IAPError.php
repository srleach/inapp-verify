<?php

namespace Srleach\InappVerify\Errors;

use Srleach\InappVerify\Errors\Exceptions\IAPAuthenticationException;
use Srleach\InappVerify\Errors\Exceptions\IAPGeneralException;
use Srleach\InappVerify\Errors\Exceptions\IAPInvalidEnvironmentException;
use Srleach\InappVerify\Errors\Exceptions\IAPInvalidJsonException;
use Srleach\InappVerify\Errors\Exceptions\IAPMalformedDataException;
use Srleach\InappVerify\Errors\Exceptions\IAPServerUnavailableException;
use Srleach\InappVerify\Errors\Exceptions\IAPSharedSecretException;
use Srleach\InappVerify\Errors\Exceptions\IAPSubscriptionExpiredException;

/**
 * Acts as an interstitial to throw the correct exception when one is encountered.
 * Class IAPError
 * @package Srleach\InappVerify\Errors
 */
class IAPError
{
    /**
     * Throw the relevant Exception.
     *
     * @param int $status The status code returned from Apple.
     *
     * @throws IAPAuthenticationException
     * @throws IAPGeneralException
     * @throws IAPInvalidEnvironmentException
     * @throws IAPInvalidJsonException
     * @throws IAPMalformedDataException
     * @throws IAPServerUnavailableException
     * @throws IAPSharedSecretException
     * @throws IAPSubscriptionExpiredException
     */
    public static function throwException($status)
    {
        switch ((int) $status) {
            case 21000:
                throw new IAPInvalidJsonException('The App Store could not read the JSON object you provided.', $status);
            case 21002:
                throw new IAPMalformedDataException('The data in the receipt-data property was malformed or missing.', $status);
            case 21003:
                throw new IAPAuthenticationException('The receipt could not be authenticated.', $status);
            case 21004:
                throw new IAPSharedSecretException('The shared secret you provided does not match the shared secret on file for your account.', $status);
            case 21005:
                throw new IAPServerUnavailableException('The receipt server is not currently available.', $status);
            case 21006:
                throw new IAPSubscriptionExpiredException('This receipt is valid but the subscription has expired.', $status);
            case 21007:
                throw new IAPInvalidEnvironmentException('This receipt is from the test environment, but it was sent to the production environment for verification.', $status);
            case 21008:
                throw new IAPInvalidEnvironmentException('his receipt is from the production environment, but it was sent to the test environment for verification.', $status);
            default:
                throw new IAPGeneralException('There was an unspecified error [' . $status . '] validating the receipt.', $status);
        }
    }
}