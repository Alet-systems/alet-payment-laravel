<?php

namespace AletPayment\AletPayment\Lib;


class AletPaymentCheckoutRequest
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
        $infoId,
        $payload,
        $apikey,
        $returnUrl,
        $callbackUrl
    ) {
        $this->subject = $subject;
        $this->amount = $amount;
        $this->mobile = $mobile;
        $this->tx = $tx;
        $this->infoId = $infoId;
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
            'infoId' => $this->infoId,
            'payload' => $this->payload,
            'apikey' => $this->apikey,
            'returnUrl' => $this->returnUrl,
            'callbackUrl' => $this->callbackUrl,
        ];
    }
}
