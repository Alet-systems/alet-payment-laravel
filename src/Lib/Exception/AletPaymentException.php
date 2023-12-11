<?php

namespace AletPayment\AletPayment\Lib\Exception;

use Exception;
use Throwable;

class AletPaymentException extends Exception
{
    public $msg;

    // Redefine the exception so message isn't optional
    public function __construct($message, Throwable $previous = null)
    {
        $this->msg = $message;
        // make sure everything is assigned properly
        parent::__construct($message, 0, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": {$this->msg}\n";
    }
}
