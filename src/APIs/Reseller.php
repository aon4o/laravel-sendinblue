<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use SendinBlue\Client\Api\ResellerApi;

/**
 * SendInBlue ResellerAPI wrapper.
 */
class Reseller extends BaseAPI
{
    protected ResellerApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new ResellerApi($this->getClient(), $this->config);
    }
}
