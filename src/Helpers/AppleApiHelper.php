<?php

namespace Srleach\InappVerify\Helpers;

use Httpful\Mime;
use Httpful\Request;
use Srleach\InappVerify\Entities\VerifiedReceipt;
use Srleach\InappVerify\Errors\Exceptions\IAPServerUnavailableException;
use Srleach\InappVerify\Errors\Exceptions\IAPSharedSecretException;

/**
 * Class AppleApiHelper
 *
 * @package Srleach\InappVerify\Helpers
 */
class AppleApiHelper
{
    /**
     * Fetch the response from apple in respect of this data.
     *
     * @param string $receiptData
     * @param string $sharedSecret
     * @return VerifiedReceipt
     */
    public function fetchResponse($receiptData, $sharedSecret)
    {
        $data = $this->postExternal($receiptData, $sharedSecret);

        return VerifiedReceipt::make($data);
    }

    /**
     * Validate that the shared secret is present, either from the constructor or an environment variable.
     * @param string $sharedSecret
     * @return string
     * @throws IAPSharedSecretException
     */
    private function checkSharedSecret($sharedSecret)
    {
        if (!is_null($sharedSecret)) {

            return $sharedSecret;
        }

        $sec = getenv('APPLE_IAP_SHARED_SECRET');

        if (!is_null($sec) && $sec) {

            return $sec;
        }

        throw new IAPSharedSecretException('An error was encountered whilst setting the Shared Secret. Ensure one is set.', 100021004);

    }

    /**
     * Sanitise the receipt data.
     *
     * @param string $receiptData
     * @return string
     */
    private function sanitise($receiptData)
    {
        return str_replace("\r\n", '', $receiptData);
    }

    /**
     * @param string $receiptData
     * @param string $sharedSecret
     * @return array
     * @throws \Exception
     */
    private function buildFormattedArray($receiptData, $sharedSecret)
    {
        return [
            'receipt-data' => $this->sanitise($receiptData),
            'password' => $this->checkSharedSecret($sharedSecret)
        ];
    }

    /**
     * @param string $receiptData
     * @param string $sharedSecret
     * @return array
     * @throws IAPServerUnavailableException
     */
    private function postExternal($receiptData, $sharedSecret)
    {
        if (!getenv('APPLE_IAP_VERIFY_URL')) {
            throw new IAPServerUnavailableException('An endpoint for polling apple was not found. Please ensure one is set.', 100021005);
        }
        $response = Request::post(getenv('APPLE_IAP_VERIFY_URL'))
            ->body($this->buildFormattedArray($receiptData, $sharedSecret))
            ->sendsType(Mime::JSON)
            ->send();

        return json_decode($response->body, true);
    }
}