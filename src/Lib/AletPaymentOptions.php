<?php

namespace AletPayment\AletPayment\Lib;

class AletPaymentOptions
{
    public $sandbox;

    public function __construct($sandbox)
    {
        $this->sandbox = $sandbox;
    }
}
