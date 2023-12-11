<?php

namespace AletPayment\AletPayment\Lib;

use JsonSerializable;

class AletPaymentCheckoutResponse implements JsonSerializable
{
    public $payment_url;

    public function __construct(
        $payment_url
    ) {
        $this->payment_url = $payment_url;
    }

    public function jsonSerialize()
    {
        return [
            "session_id" => $this->session_id,
          
        ];
    }

    public static function fromJson($data)
    {
        return new AletPaymentCheckoutResponse($data["data"]["toPayUrl"]);
    }
}
