<?php

use AletPayment\AletPayment\AletPayment;
use AletPayment\AletPayment\Helper\AletPaymentSupport;
use AletPayment\AletPayment\Lib\AletPaymentCheckoutResponse;
use AletPayment\AletPayment\Lib\AletPaymentOptions;
use AletPayment\AletPayment\Lib\Exception\AletPaymentBadRequestException;
use AletPayment\AletPayment\Lib\Exception\AletPaymentUnAuthorizedException;
use Illuminate\Support\Carbon;

test('checkout Is istance of  Checkout', function () {
    $arifpay = new AletPayment('myAPI');
    $this->assertTrue($arifpay->checkout() instanceof AletPayment);
});
/*
test('Creates Checkout Session', function () {
    $arifpay = new AletPayment('HrUDdrOv3TV92cgpzpbQ3DakLJtHfYfh');
    $d = new  Carbon();
    $d->setMonth(10);
    $expired = AletPaymentSupport::getExpireDateFromDate($d);
    $data = new AletPaymentCheckoutRequest(
        cancel_url: 'https://api.arifpay.com',
        error_url: 'https://api.arifpay.com',
        notify_url: 'https://gateway.arifpay.net/test/callback',
        expireDate: $expired,
        nonce: floor(rand() * 10000) . toString(),
        beneficiaries: [
            AletPaymentBeneficary::fromJson([
                "accountNumber" => '01320811436100',
                "bank" => 'AWINETAA',
                "amount" => 10.0,
            ]),
        ],
        paymentMethods: ["CARD"],
        success_url: 'https://gateway.arifpay.net',
        items: [
            AletPaymentCheckoutItem::fromJson([
                "name" => 'Bannana',
                "price" => 10.0,
                "quantity" => 1,
            ]),
        ],
    );
    $session =  $arifpay->checkout()->create($data, new AletPaymentOptions(sandbox: true));
    $this->assertTrue($session instanceof AletPaymentCheckoutResponse);
    $this->assertTrue(!is_null($session->sessionId));
});

test('Check API key is Invalid', function () {
    try {
        $arifpay = new AletPayment('myAPI');
        $arifpay->checkout()->fetch('fake', new AletPaymentOptions(sandbox: true));
    } catch (AletPaymentUnAuthorizedException $e) {

        $this->assertTrue($e instanceof AletPaymentUnAuthorizedException);
    }
});

test('Check getting Session', function () {
    $arifpay = new AletPayment('HrUDdrOv3TV92cgpzpbQ3DakLJtHfYfh');
    $session = $arifpay->checkout()->fetch('11bb7352-b228-4c75-9f0d-8a035aeac08b', new AletPaymentOptions(sandbox: true));
    $this->assertTrue($session->uuid == "11bb7352-b228-4c75-9f0d-8a035aeac08b");
});

test("Check Production doesn't work with Test key", function () {
    try {
        $arifpay = new AletPayment('HrUDdrOv3TV92cgpzpbQ3DakLJtHfYfh');
        $arifpay->checkout()->fetch('11bb7352-b228-4c75-9f0d-8a035aeac08b', new AletPaymentOptions(sandbox: false));
    } catch (AletPaymentBadRequestException $e) {
        $this->assertTrue($e instanceof AletPaymentBadRequestException);
    }
}); */
