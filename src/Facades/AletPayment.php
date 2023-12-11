<?php

namespace AletPayment\AletPayment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AletPayment\AletPayment\AletPayment
 */
class AletPayment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'arifpay';
    }
}
