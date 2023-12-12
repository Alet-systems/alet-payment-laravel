<?php

namespace AletPayment\AletPayment\Lib\Core\DirectPay;

use AletPayment\AletPayment\AletPayment;
use AletPayment\AletPayment\Helper\AletPaymentSupport;
use AletPayment\AletPayment\Lib\AletPaymentAPIResponse;
use AletPayment\AletPayment\Lib\AletPaymentTransferResponse;
use AletPayment\AletPayment\Lib\Exception\AletPaymentNetworkException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use League\Flysystem\ConnectionErrorException;

class AletPaymentAwashWallet
{
    public $http_client;

    public function __construct($http_client)
    {
        $this->http_client = $http_client;
    }

    public function pay($checksessionID, $phoneNumber): AletPaymentTransferResponse
    {
        try {
            $response = $this->http_client->post(AletPayment::API_VERSION."/checkout/awash/wallet/direct/transfer", [
                RequestOptions::JSON => [
                    "sessionId" => $checksessionID,
                    "phoneNumber" => $phoneNumber,
                ],
            ]);

            $arifAPIResponse = AletPaymentAPIResponse::fromJson(json_decode($response->getBody(), true));

            return AletPaymentTransferResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new AletPaymentNetworkException();
        } catch (ClientException $e) {
            AletPaymentSupport::__handleException($e);

            throw $e;
        }
    }

    public function verify($checksessionID, $otp, $fail = false): AletPaymentTransferResponse
    {
        try {
            $response = $this->http_client->post(AletPayment::API_VERSION."/checkout/awash/wallet/direct/verifyOTP", [
                RequestOptions::JSON => [
                    "sessionId" => $checksessionID,
                    "paymentRunMode" => $fail ? "FAIL" : "SUCCESS",
                    "otp" => $otp,
                ],
            ]);

            $arifAPIResponse = AletPaymentAPIResponse::fromJson(json_decode($response->getBody(), true));

            return AletPaymentTransferResponse::fromJson($arifAPIResponse->data);
        } catch (ConnectionErrorException $e) {
            throw new AletPaymentNetworkException();
        } catch (ClientException $e) {
            AletPaymentSupport::__handleException($e);

            throw $e;
        }
    }
}
