<?php

namespace AletPayment\AletPayment\Helper;

use AletPayment\AletPayment\Lib\Exception\AletPaymentBadRequestException;
use AletPayment\AletPayment\Lib\Exception\AletPaymentException;
use AletPayment\AletPayment\Lib\Exception\AletPaymentNetworkException;
use AletPayment\AletPayment\Lib\Exception\AletPaymentNotFoundException;
use AletPayment\AletPayment\Lib\Exception\AletPaymentUnAuthorizedException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Carbon;

class AletPaymentSupport
{
    public static function getExpireDateFromDate(Carbon $date)
    {
        return $date->toDateTimeLocalString();
    }

    public static function __handleException(ClientException $e)
    {
        $response = $e->getResponse();
        if ($response) {
            if ($response->getStatusCode() == 401) {
                throw new AletPaymentUnAuthorizedException('Invalid authentication credentials', $e);
            }
            if ($response->getStatusCode() === 400) {
                $responseBodyAsString = $response->getBody()->getContents();
                $msg = "Invalid Request, check your Request body.";
                if (! empty($responseBodyAsString)) {
                    $responseJson = json_decode($responseBodyAsString, true);
                    $msg = $responseJson["msg"];
                }

                throw new AletPaymentBadRequestException($msg, $e);
            }
            if ($response->getStatusCode() === 404) {
                $responseBodyAsString = $response->getBody()->getContents();
                $msg = "Invalid Request, Not found.";
                if (! empty($responseBodyAsString)) {
                    $responseJson = json_decode($responseBodyAsString, true);
                    $msg = $responseJson["msg"];
                }

                throw new AletPaymentNotFoundException($msg, $e);
            }

            throw new AletPaymentException($e->response->data["msg"], $e);
        } else {
            throw new AletPaymentNetworkException($e);
        }
    }
}
