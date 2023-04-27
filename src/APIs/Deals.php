<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\DealsApi;

/**
 * SendInBlue DealsAPI wrapper.
 */
class Deals extends BaseAPI
{
    protected DealsApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new DealsApi($this->getClient(), $this->config);
    }
}
