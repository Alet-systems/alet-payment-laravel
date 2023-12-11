<?php

namespace AletPayment\AletPayment\Commands;

use Illuminate\Console\Command;

class AletPaymentCommand extends Command
{
    public $signature = 'arifpay';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
