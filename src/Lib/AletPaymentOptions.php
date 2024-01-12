<?php

namespace AletPayment\AletPayment\Lib;

class AletPaymentOptions
{
   
    public $sandbox;
    public $mobile;

    public function __construct($sandbox, $mobile = false)
    {
        $this->sandbox = $sandbox;
        $this->mobile = $mobile;
    }
}
