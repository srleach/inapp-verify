# inapp-verify
Verifies iOS App store receipts with Apple for authenticity

## Installation

Install, as with most dependencies with Composer.

````bash
composer require srleach/inapp-verify
````

## Configuration

You'll need to set a couple of environment variables for this to work correctly.

| Environment Variable | Description |
|----------------------|-------------|
| APPLE_IAP_SHARED_SECRET | The shared secret used in the iOS App |
| APPLE_IAP_VERIFY_URL | The URL used to poll the app store for results |

An example for an application using the popular Dotenv library:

````
APPLE_IAP_VERIFY_URL=https://sandbox.itunes.apple.com/verifyReceipt
APPLE_IAP_SHARED_SECRET=kmdfkmsKADMF999KM

````

## Usage

You can poll the service by passing the receipt data as gleaned from the response from Apple by into `getReceipt()`.

````php
return IAP::getReceipt($receiptData);
````
Optionally, you may choose to override the environment set shared secret:

````php
return IAP::getReceipt($receiptData, $sharedSecret);
````
