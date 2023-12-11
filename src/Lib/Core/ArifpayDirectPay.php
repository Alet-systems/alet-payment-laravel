<?php

namespace AletPayment\AletPayment\Lib\Core;

use AletPayment\AletPayment\Lib\Core\DirectPay\AletPaymentAwash;
use AletPayment\AletPayment\Lib\Core\DirectPay\AletPaymentAwashWallet;
use AletPayment\AletPayment\Lib\Core\DirectPay\AletPaymentTelebirr;

class AletPaymentDirectPay
{
    // TODO: transactionStatus: string; change to enum
    // TODO: paymentType: string; change to enum


    public $http_client;

    public $telebirr;
    public $awash;
    public $awash_wallet;

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
        $this->telebirr = new AletPaymentTelebirr($this->http_client);
        $this->awash = new AletPaymentAwash($this->http_client);
        $this->awash_wallet = new AletPaymentAwashWallet($this->http_client);
    }
}
