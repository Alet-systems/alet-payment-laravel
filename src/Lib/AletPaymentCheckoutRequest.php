<?php

namespace AletPayment\AletPayment\Lib;

use JsonSerializable;

class AletPaymentCheckoutRequest implements JsonSerializable
{
    public $subject;
    public $amount;
    public $mobile;

    public $tx;
    public $h5id;
    public $payload;

    public $apikey;
    public $returnUrl;
    public $callbackUrl;

    public function __construct(
        $subject,
        $amount,
        $mobile,
        $tx,
        $h5id,
        $payload,
        $apikey,
        $returnUrl,
        $callbackUrl
    ) {
        $this->subject = $subject;
        $this->amount = $amount;
        $this->mobile = $mobile;
        $this->tx = $tx;
        $this->h5id = $h5id;
        $this->payload = $payload;
        $this->apikey = $apikey;
        $this->returnUrl = $returnUrl;
        $this->callbackUrl = $callbackUrl;
    }

    public function jsonSerialize()
    {
        return [
            'subject' => $this->subject,
            'amount' => $this->amount,
            'mobile' => $this->mobile,
            'tx' => $this->tx,
            'h5id' => $this->h5id,
            'payload' => $this->payload,
            'apikey' => $this->apikey,
            'returnUrl' => $this->returnUrl,
            'callbackUrl' => $this->callbackUrl,
        ];
    }
}
