<?php

namespace AletPayment\AletPayment\Lib;

class AletPaymentAPIResponse
{
    public $error;
    public $msg;
    public $data;

    public function __construct($error, $msg, $data)
    {
        $this->error = $error;
        $this->msg = $msg;
        $this->data = $data;
    }

    public static function fromJson($json)
    {
        return new AletPaymentAPIResponse($json["error"], $json["msg"], $json["data"]);
    }
}
