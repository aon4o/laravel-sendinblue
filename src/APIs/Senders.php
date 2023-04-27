<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\SendersApi;

/**
 * SendInBlue SendersAPI wrapper.
 */
class Senders extends BaseAPI
{
    protected SendersApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new SendersApi($this->getClient(), $this->config);
    }
}
