<?php

namespace Srleach\InappVerify\Entities;

use Srleach\InappVerify\Errors\IAPError;

/**
 * Verified Receipt Object. Returned in the event of success.
 *
 * Class VerifiedReceipt
 * @package Srleach\InappVerify\Entities
 */
class VerifiedReceipt
{
    public $latest_receipt_info;
    public $status;

    /**
     * Get an array of the most recent receipt data. This will contain product and purchase info.
     *
     * @return array
     */
    public function getLatestReceiptData()
    {
        return array_pop($this->latest_receipt_info);
    }

    /**
     * Make the object if all has been successful.
     *
     * @param array $params
     * @return VerifiedReceipt
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPAuthenticationException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPGeneralException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPInvalidEnvironmentException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPInvalidJsonException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPMalformedDataException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPServerUnavailableException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPSharedSecretException
     * @throws \Srleach\InappVerify\Errors\Exceptions\IAPSubscriptionExpiredException
     */
    public static function make(array $params)
    {
        $validatedReceipt = new self;

        foreach ($params as $key => $value) {
            $validatedReceipt->{$key} = $value;
        }

        if ($validatedReceipt->status) {

            IAPError::throwException($validatedReceipt->status);
        }

        return $validatedReceipt;
    }
}