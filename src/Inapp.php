<?php
/**
 * //TODO: Apache License V2
 */

namespace Srleach\InappVerify;
use Httpful\Mime;
use Httpful\Request;
use Srleach\InappVerify\Entities\VerifiedReceipt;

/**
 * Test Harness
 * 
 * Class Inapp
 * @package Srleach\InappVerify
 */
class Inapp
{
    /**
     * Verify a purchase with Apple's Server.
     */
    public function verify($receiptData, $sharedSecret = null)
    {
        $data = $this->postExternal($receiptData, $sharedSecret);

        $receiptValidated = new VerifiedReceipt();

        foreach ($data as $key => $value) {
            $receiptValidated->{$key} = $value;
        }

        return $receiptValidated;
    }

    private function checkSharedSecret($sharedSecret)
    {
        if (!is_null($sharedSecret)) {

            return $sharedSecret;
        }

        $sec = getenv('APPLE_IAP_SHARED_SECRET');

        if (!is_null($sec) && $sec) {

            return $sec;
        }

        throw new \Exception('A shared secret must be set.');

    }

    private function sanitise($receiptData)
    {
        return str_replace("\n", '', $receiptData);
    }

    private function buildFormattedArray($receiptData, $sharedSecret)
    {
        return [
            'receipt-data' => $this->sanitise($receiptData),
            'password' => $this->checkSharedSecret($sharedSecret)
        ];
    }

    private function postExternal($receiptData, $sharedSecret)
    {
        $response = Request::post('https://sandbox.itunes.apple.com/verifyReceipt')
            ->body($this->buildFormattedArray($receiptData, $sharedSecret))
            ->sendsType(Mime::JSON)
            ->send();

        return json_decode($response->body, true);
    }
}