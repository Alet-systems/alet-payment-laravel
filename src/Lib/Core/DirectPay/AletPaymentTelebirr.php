<?php

namespace AletPayment\AletPayment\Lib\Core\DirectPay;

use AletPayment\AletPayment\AletPayment;
use AletPayment\AletPayment\Helper\AletPaymentSupport;
use AletPayment\AletPayment\Lib\AletPaymentAPIResponse;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutRequest;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutResponse;
use AletPayment\AletPayment\Lib\AletPaymentOptions;
use AletPayment\AletPayment\Lib\AletPaymentTransferResponse;
use AletPayment\AletPayment\Lib\Exception\AletPaymentNetworkException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class AletPaymentTelebirr
{
    public $http_client;

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
    }

    public function pay(AletPaymentCheckoutRequest $aletpaymentCheckoutRequest, AletPaymentOptions $option = null)
    {
        try {
            $request_url = $option->mobile ? AletPayment::API_VERSION . "/telebirr/pay/app" : AletPayment::API_VERSION . "/telebirr/pay/web";
            $response = $this->http_client->post($request_url, [
                RequestOptions::JSON => $aletpaymentCheckoutRequest->jsonSerialize(),
            ]);

            $arifAPIResponse = AletPaymentAPIResponse::fromJson(json_decode($response->getBody(), true));

            return $arifAPIResponse->data;
        } catch (ConnectionErrorException $e) {
            throw new AletPaymentNetworkException();
        } catch (ClientException $e) {
            AletPaymentSupport::__handleException($e);

            throw $e;
        }
    }
}
