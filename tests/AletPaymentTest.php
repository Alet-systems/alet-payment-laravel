<?php

use AletPayment\AletPayment\Lib\AletPayment;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('Creates Instance', function () {
    $this->assertTrue(new AletPayment('myAPI') instanceof AletPayment);
});

it('Is Latest Version Instance', function () {
    $this->assertTrue((new AletPayment('myAPI'))->PACKAGE_VERSION == '1.1.2');
});

it('Check API key is Set', function () {
    $aletsystems = new AletPayment('myAPI');
    $this->assertTrue($aletsystems->apikey == "myAPI");
});
