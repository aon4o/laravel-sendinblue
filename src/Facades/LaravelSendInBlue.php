<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\Facades;

use Illuminate\Support\Facades\Facade;
use RuntimeException;

/**
 * @see \Aon2003\LaravelSendInBlue\LaravelSendInBlue
 */
class LaravelSendInBlue extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return \Aon2003\LaravelSendInBlue\LaravelSendInBlue::class;
    }


}
