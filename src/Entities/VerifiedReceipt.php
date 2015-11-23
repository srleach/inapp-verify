<?php

namespace Srleach\InappVerify\Entities;
/**
 * Created by PhpStorm.
 * User: seanleach
 * Date: 23/11/2015
 * Time: 19:50
 */
class VerifiedReceipt
{
    public $latest_receipt_info;

    public function getLatestReceiptData()
    {
        if (is_null($this->latest_receipt_info)) {

            throw new \Exception('Receipt info is not set. Is the receipt valid?');
        }

        return array_pop($this->latest_receipt_info);
    }
}