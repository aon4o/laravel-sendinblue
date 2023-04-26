<?php

namespace Aon2003\LaravelSendInBlue\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Aon2003\LaravelSendInBlue\LaravelSendInBlue
 */
class LaravelSendInBlue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Aon2003\LaravelSendInBlue\LaravelSendInBlue::class;
    }
}
