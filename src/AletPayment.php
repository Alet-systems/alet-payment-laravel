<?php

namespace AletPayment\AletPayment;

use AletPayment\AletPayment\Lib\Core\AletPaymentCheckout;
use AletPayment\AletPayment\Lib\Core\AletPaymentDirectPay;
use GuzzleHttp\Client;

class AletPayment
{
    public $http_client;
    public $apikey;

    public $DEFAULT_HOST = 'http://198.199.80.48:1270';
    public const API_VERSION = '/api';
    public static $PACKAGE_VERSION = '1.0.0';
    public $DEFAULT_TIMEOUT = 1000 * 60 * 2;
    public $checkout;
    public $directPay;

    public function __construct()
    {
        $this->http_client = new Client([
            'base_uri' => $this->DEFAULT_HOST,
            'headers' => [
                "Content-Type" => "application/json",
                "Accepts" => "application/json",
            ],
        ]);
        $this->checkout = new AletPaymentCheckout($this->http_client);
        $this->directPay = new AletPaymentDirectPay($this->http_client);
    }
}
