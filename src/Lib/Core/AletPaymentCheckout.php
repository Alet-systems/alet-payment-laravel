<?php

namespace AletPayment\AletPayment\Lib\Core;

use AletPayment\AletPayment\AletPayment;
use AletPayment\AletPayment\Helper\AletPaymentSupport;
use AletPayment\AletPayment\Lib\AletPaymentAPIResponse;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutRequest;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutResponse;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutSession;
use AletPayment\AletPayment\Lib\AletPaymentOptions;
use AletPayment\AletPayment\Lib\Exception\AletPaymentNetworkException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class AletPaymentCheckout
{
    // TODO: transactionStatus: string; change to enum
    // TODO: paymentType: string; change to enum


    public $http_client;

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
    }

    public function create(AletPaymentCheckoutRequest $aletpaymentCheckoutRequest, AletPaymentOptions $option = null): AletPaymentCheckoutResponse
    {
        if ($option == null) {
            $option = new AletPaymentOptions(false);
        }

        try {
            $request_url = $aletpaymentCheckoutRequest->mobile ? AletPayment::API_VERSION . "/telebirr/pay/app" : AletPayment::API_VERSION . "/telebirr/pay/web";
            $response = $this->http_client->post($request_url, [
                RequestOptions::JSON => $aletpaymentCheckoutRequest->jsonSerialize(),
            ]);

            $arifAPIResponse = AletPaymentAPIResponse::fromJson(json_decode($response->getBody(), true));

            return AletPaymentCheckoutResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new AletPaymentNetworkException();
        } catch (ClientException $e) {
            AletPaymentSupport::__handleException($e);

            throw $e;
        }
    }

    public function fetch(string $session_iD, AletPaymentOptions $option = null): AletPaymentCheckoutSession
    {
        if ($option == null) {
            $option = new AletPaymentOptions(false);
        }

        try {
            $basePath = $option->sandbox ? '/sandbox' : '';
            $response = $this->http_client->get(AletPayment::API_VERSION . "$basePath/checkout/session/$session_iD");

            $arifAPIResponse = AletPaymentAPIResponse::fromJson(json_decode($response->getBody(), true));

            return AletPaymentCheckoutSession::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new AletPaymentNetworkException();
        } catch (RequestException $e) {
            AletPaymentSupport::__handleException($e);

            throw $e;
        }
    }

    public function cancel(string $session_iD, AletPaymentOptions $option = null): AletPaymentCheckoutSession
    {
        if ($option == null) {
            $option = new AletPaymentOptions(false);
        }

        try {
            $basePath = $option->sandbox ? '/sandbox' : '';
            $response = $this->http_client->post(AletPayment::API_VERSION . "$basePath/checkout/session/cancel/$session_iD");

            $arifAPIResponse = AletPaymentAPIResponse::fromJson(json_decode($response->getBody(), true));

            return AletPaymentCheckoutSession::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new AletPaymentNetworkException();
        } catch (RequestException $e) {
            AletPaymentSupport::__handleException($e);

            throw $e;
        }
    }
}
