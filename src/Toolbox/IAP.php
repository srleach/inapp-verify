<?php

namespace Srleach\InappVerify\Toolbox;

use Srleach\InappVerify\Helpers\AppleApiHelper;

/**
 * Class Verify
 * @package Srleach\InappVerify\Toolbox
 */
class IAP
{
    /**
     * Get the receipt data from the encrypted receipt given.
     *
     * @param $receiptData
     * @param $sharedSecret
     * @return \Srleach\InappVerify\Entities\VerifiedReceipt
     */
    public static function getReceipt($receiptData, $sharedSecret)
    {
        $appleApiHelper = new AppleApiHelper();

        return $appleApiHelper->fetchResponse($receiptData, $sharedSecret);
    }
}