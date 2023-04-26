<?php

namespace Aon2003\LaravelSendInBlue\Commands;

use Illuminate\Console\Command;

class LaravelSendInBlueCommand extends Command
{
    public $signature = 'laravel-sendinblue';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
